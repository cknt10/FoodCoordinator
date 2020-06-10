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
  getServerLoginData(): Promise<User> {
    console.log('frage Server an');

    const httpOptions = {
      headers: new HttpHeaders({
        'Content-Type': 'application/json',
        username: 'test',
        password: '123456',
      }),
    };

    const requestLink = 'http://xcsd.ddns.net/api/backend/login/login.php';

    //to-post including incoming parameter: username, password

    console.log('request finished');

    return this.http.get<User>(requestLink /*, httpOptions*/).toPromise();
  }

  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  postServerLoginData(username: string, password: string): Promise<User> {
    console.log('Server request with username and password');

    console.log(username);
    console.log(password);


    let headers = new HttpHeaders();
    headers.append('Content-Type', 'application/json');
    headers.append('Access-Control-Allow-Origin', 'http://xcsd.ddns.net/');

    let params = new HttpParams().set("username",username).set("password", password); //Create new HttpParams

    console.log(headers);
    console.log(params);

    const requestLink = 'http://xcsd.ddns.net/api/backend/login/login.php';

    //to-post including incoming parameter: username, password

    console.log('request finished');

    return this.http.post<User>(requestLink, {headers: headers, params: params }).pipe(catchError(this.handleError)).toPromise();

  }



  handleError(error: HttpErrorResponse) {
    let errorMessage = 'Unknown error!';
    if (error.error instanceof ErrorEvent) {
      // Client-side errors
      errorMessage = `Error: ${error.error.message}`;
    } else {
      // Server-side errors
      errorMessage = `Error Code: ${error.status}\nMessage: ${error.message}`;
    }
    window.alert(errorMessage);
    return throwError(errorMessage);
  }

}
