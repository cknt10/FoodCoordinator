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


private  UserData: User;
private convert: User;


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
 getUser(){

  this.reqService.getServerLoginData().subscribe((data: User) =>{


    this.UserData=data['user'];

   // this.UserData = new User (data.id, data.username, data.email, data.firstname, data.name,
     // data.birthday, data.gender, data.street, data.postalCode, data.city, data.isPremium);
//this.UserData= new User(data);
console.log(this.UserData);


  }), error => {
    console.log('Dat mit der Entfaltung klappt noch nich so gut');
  };
  ;

 /*this.UserData = new User (this.convert.id, this.convert.username, this.convert.email, this.convert.firstname, this.convert.name,
    this.convert.birthday, this.convert.gender, this.convert.street, this.convert.postalCode, this.convert.city, this.convert.isPremium);*/
    console.log('bis hierher klappts');
    //console.log(this.UserData);

  return this.UserData;
}
/////////////////////////////////////////////////////////////////////////////////////////////////////////
/*
 gethim(){
  this.UserData =
   new User (tabelle.id, tabelle.username,tabelle.email,tabelle.firstname,
    tabelle.name,tabelle.birthday,tabelle.gender,tabelle.street, tabelle.postalCode, tabelle.city, tabelle.isPremium)

  return this.UserData;
}*/
}
