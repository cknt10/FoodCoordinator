import { Injectable } from '@angular/core';
import {
  HttpClient,
  HttpHeaders,
  HttpParams,
  HttpErrorResponse,
} from '@angular/common/http';
import { Observable } from 'rxjs';
import { User } from './User';

import { throwError } from 'rxjs';
import { catchError } from 'rxjs/operators';

@Injectable({
  providedIn: 'root',
})
export class LoginReqService {
  private errorValue: string;

  constructor(private http: HttpClient) {}

  /////////////////////////////////method to display error message to user///////////////////////////
  getErrorMessageUser(): string {
    return this.errorValue;
  }

  ///////////////////////////////////////HTTP-Request method//////////////////////////////////////////////////////////////////
  getServerLoginData(username: string, password: string): Promise<User> {
    console.log('server request with username and password');

    let params = new HttpParams()
      .set('username', username)
      .set('password', password); //create new httpParams

    console.log(params);

    const requestLink = 'http://xcsd.ddns.net/api/backend/login/login.php';

    //to-post including incoming parameter: username, password

    console.log('request finished');

    return this.http
      .get<User>(requestLink, { params: params })
      .pipe(catchError(this.handleError))
      .toPromise();
  }

  ///////////////////////////////////////method to handle error//////////////////////////////////////////////////////////////////
  handleError(error: HttpErrorResponse) {
    let errorMessage = 'Unknown error!';
    if (error.error instanceof ErrorEvent) {
      // Client-side errors
      errorMessage = `Error: ${error.error.message}`;
    } else {
      // Server-side errors
      if (error.status == 401) {
        this.errorValue = `Die Verbindung zum Server kann nicht aufgebaut werden`;
      }
      if (error.status == 403) {
        this.errorValue = `Der Benutzername exisitert bereits.`;
      }
      if (error.status == 404) {
        this.errorValue = `Falscher Benutzername oder falsches Passwort`;
      }
      if (error.status == 500) {
        this.errorValue = `Die Verbindung zum Server wurde fehlgeschlagen`;
      }
      errorMessage = `Error Code: ${error.status}\nMessage: ${error.message}`;
    }
    return throwError(errorMessage);
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
    console.log('Server request with username and password');

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
    console.log(params);

    const requestLink = 'http://xcsd.ddns.net/api/backend/login/register.php';

    //to-post including incoming parameter: username, password

    console.log('request finished');

    return this.http
      .get<User>(requestLink, { params: params })
      .pipe(catchError(this.handleError))
      .toPromise();
  }
}
