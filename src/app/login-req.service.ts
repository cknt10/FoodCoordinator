import { Injectable } from '@angular/core';
import {
  HttpClient,
  HttpParams,
  HttpErrorResponse,
} from '@angular/common/http';
import { throwError } from 'rxjs';
import { catchError, retry, map } from 'rxjs/operators';

import { User } from './User';
import { Cities } from './cites';

@Injectable({
  providedIn: 'root',
})
export class LoginReqService {
  private errorValue: string;
  private cities: Cities[] = [];

  constructor(private http: HttpClient) {}

  /////////////////////////////////method to display error message to user///////////////////////////
  getErrorMessage(): string {
    return this.errorValue;
  }

  /////////////////////////////////method to get existing cities with postalcode///////////////////////////
  getCities() {
    return this.cities;
  }

  ///////////////////////////////////////HTTP-Request method//////////////////////////////////////////////////////////////////
  getServerLoginData(username: string, password: string): Promise<User> {

    let params = new HttpParams()
      .set('username', username)
      .set('password', password);

    const requestLink = 'http://xcsd.ddns.net/api/backend/login/login.php';

    return this.http
      .get<User>(requestLink, { params: params })
      //.pipe(catchError(this.handleError))
      .toPromise();
  }

  ///////////////////////////////////////method to send Http-Request with new user//////////////////////////////////////////////////////////
  getServerRegistrationData(
    username: string,
    password: string,
    firstname: string,
    name: string,
    gender: string,
    street: string,
    houseNumber: string,
    postcode: string,
    city: string,
    birthday: string,
    email: string
  ): Promise<User> {

    let params = new HttpParams()
      .set('username', username)
      .set('password', password)
      .set('firstname', firstname)
      .set('name', name)
      .set('gender', gender)
      .set('street', street)
      .set('houseNumber', houseNumber)
      .set('postcode', postcode)
      .set('city', city)
      .set('birthday', birthday)
      .set('email', email);

    const requestLink = 'http://xcsd.ddns.net/api/backend/login/register.php';

    return this.http
      .get<User>(requestLink, { params: params })
      //.pipe(catchError(this.handleError))
      .toPromise();
  }

  /////////////////////////////////save cities from server///////////////////////////
  async getServerCities(postcode: number): Promise<Cities[]> {
    await this.fetchServerCities(postcode).then((data: Cities) => {
      data['cities'].forEach((value: Cities) => {
        this.cities.push(new Cities(value));
      });
    }).catch (error => {
      this.handleErrorCities(error);
      });
      
    return this.cities;
  }

  /////////////////////////////////Http-Request to get all Cities///////////////////////////
  async fetchServerCities(postcode: number): Promise<Cities> {

    let params = new HttpParams()
    .set('postcode', postcode.toString());
    const requestLink = 'http://xcsd.ddns.net/api/backend/order/getcities.php';

    return this.http
      .get<Cities>(requestLink, { params: params })
      /*.pipe(
        retry(2),
        catchError(this.handleErrorCities))*/
        .pipe(retry(2))
      .toPromise();
  }

  ///////////////////////////////////////method to handle error for cities//////////////////////////////////////////////////////////////////
  handleErrorCities(error: Response) {
    if (error instanceof ErrorEvent) {
      // Client-side errors
      this.errorValue = `Unerwarteter Fehler. Bitte versuchen Sie später noch Mal.`;
    } else {
      // Server-side errors
      if (error.status === 401) {
        this.errorValue = `Die Verbindung zum Server kann nicht aufgebaut werden`;
      }
      if (error.status === 403) {
        this.errorValue = `Die Stadt exisitert bereits.`;
      }
      if (error.status === 404) {
        this.errorValue = `Falsche Postleitzahl oder die Stadt wurde nicht richtig geschrieben.`;
      }
      if (error.status === 500) {
        this.errorValue = `Die Verbindung zum Server ist fehlgeschlagen`;
      }
    }
    return this.errorValue;
  }
}
