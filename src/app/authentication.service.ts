import { Injectable } from '@angular/core';
import { LoginReqService } from './login-req.service';
import { throwError } from 'rxjs';
import { User } from './User';
import { HttpClient, HttpErrorResponse } from '@angular/common/http';

@Injectable({
  providedIn: 'root'
})
export class AuthenticationService {


public UserData: User;


  constructor(private reqService: LoginReqService, private http: HttpClient) {

   }

  private handleError(error: HttpErrorResponse) {
    console.log(error);

    // return an observable with a user friendly message
    return throwError('Error! something went wrong.');
  }

/////////////////////////////////////////////////////////////////////////////////////////////////////////
// set data from json to new user
async setUserData(){

  this.reqService.getServerLoginData().subscribe((data: User) =>{


    this.UserData=new User (data['user']);

    console.log(this.UserData);


    }),
  error => {
  console.log('Dat mit der Entfaltung klappt noch nich so gut');
  };
  ;

 console.log('bis hierher klappts');

}
/////////////////////////////////////////////////////////////////////////////////////////////////////////
//get user data
async getUser(){
  if(this.UserData==null){
    this.setUserData();
  }
  return this.UserData;
}

}
