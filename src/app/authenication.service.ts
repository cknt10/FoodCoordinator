import { Injectable } from '@angular/core';
import { LoginReqService } from './login-req.service';
import { Subscription, Observable,throwError  } from 'rxjs';
import { User } from './User';
import { map, catchError } from 'rxjs/operators';
import { HttpClient, HttpErrorResponse, HttpParams } from '@angular/common/http';


import * as tabelle from 'testnutzer.json';

@Injectable({
  providedIn: 'root'
})
export class AuthenicationService {


private UserData: User;


  constructor(private reqService: LoginReqService, private http: HttpClient) {

   }

  private handleError(error: HttpErrorResponse) {
    console.log(error);

    // return an observable with a user friendly message
    return throwError('Error! something went wrong.');
  }

  //////////////////////////////////////////////////////////////////////////////////////
setUserData(): Observable<User>{

  console.log('Beziehe Daten aus Http_Request Methode aus login.service');

  return this.reqService.getServerLoginData().pipe(
    map((res) => {
      this.UserData = res['user'];
      return this.UserData;
  }),
  catchError(this.handleError));

}
/////////////////////////////////////////////////////////////////////////////////////////////////////////
/*  async getUser(){

    this.setUserData().subscribe((res: User) => {
      this.ConvertedUserData = res;
    },
    (err) => {
      this.error= err;
    }
    );

    console.log("Auslesen erfolreich");

    return this.UserData;
} */
/////////////////////////////////////////////////////////////////////////////////////////////////////////

 gethim(){
  this.UserData =
   new User (tabelle.id, tabelle.username,tabelle.email,tabelle.firstname,tabelle.name,tabelle.birthday,tabelle.gender,tabelle.street)

  return this.UserData;
}
}
