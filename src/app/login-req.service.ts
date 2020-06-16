import { Injectable } from '@angular/core';
import { HttpClient, HttpHeaders, HttpParams, HttpErrorResponse } from '@angular/common/http';
import { Observable } from 'rxjs';
import { User } from './User';

import {  throwError } from 'rxjs';
import { catchError } from 'rxjs/operators';

@Injectable({
  providedIn: 'root',
})
export class LoginReqService {
  constructor(
    private http: HttpClient
    ) {}

  ///////////////////////////////////////HTTP-Request method//////////////////////////////////////////////////////////////////
  getServerLoginData(
    username: string,
    password: string
    ): Promise<User> {
    console.log('Server request with username and password');

    console.log(username);
    console.log(password);

    let params = new HttpParams()
    .set("username",username)
    .set("password", password); //Create new HttpParams

    console.log(params);

    const requestLink = 'http://xcsd.ddns.net/api/backend/login/login.php';

    //to-post including incoming parameter: username, password

    console.log('request finished');

    return this.http.get<User>(requestLink, { params: params }).pipe(catchError(this.handleError)).toPromise();

  }


 ///////////////////////////////////////method to handle error//////////////////////////////////////////////////////////////////
 handleError(error: HttpErrorResponse) {
    let errorMessage = 'Unknown error!';
    if (error.error instanceof ErrorEvent) {
      // Client-side errors
      errorMessage = `Error: ${error.error.message}`;
    } else {
      // Server-side errors
      errorMessage = `Error Code: ${error.status}\nMessage: ${error.message}`;
    }
    //window.alert(errorMessage);
    return throwError(errorMessage);
  }


  myhandleError(error: HttpErrorResponse) {
    let errorMessage;
    if (error.status == 401) {
     return errorMessage `Die Verbindung zum Server kann nicht aufgebaut werden`;
    }
    if (error.status == 403) {
      return errorMessage = `Der Benutzername exisitert bereits. Bitte suchen sich einen anderen Benutzernamen aus`;
    }
    if (error.status == 404) {
     return errorMessage = `Falscher Benutzername oder falsches Password`;
    }
    if (error.status == 500){
     return errorMessage = `Die Verbidung zum Server wurde fehlgeschlagen`;
    }
    //window.alert(errorMessage);
    //return throwError(errorMessage);
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
    email: string,
    ): Promise<User> {

    console.log('Server request with username and password');

    let params = new HttpParams()
    .set("username",username)
    .set("password", password)
    .set("firstname", firstname)
    .set("name", name)
    .set("gender", gender)
    .set("street", street)
    .set("houseNumber", houseNumber)
    .set("postcode", postcode)
    .set("city", city)
    .set("birthday", birthday)
    .set("email", email)
    ;

    console.log(params);

    const requestLink = 'http://xcsd.ddns.net/api/backend/login/register.php';

    //to-post including incoming parameter: username, password

    console.log('request finished');

    return this.http.get<User>(
      requestLink,
      { params: params
      }).pipe(catchError(this.handleError)).toPromise();

  }


}
