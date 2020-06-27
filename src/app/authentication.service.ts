import { Injectable } from '@angular/core';
import { LoginReqService } from './login-req.service';
import { throwError } from 'rxjs';
import { User } from './User';
import { HttpClient, HttpErrorResponse } from '@angular/common/http';
import { retry, catchError } from 'rxjs/operators';

@Injectable({
  providedIn: 'root',
})
export class AuthenticationService {
  private UserData: User;

  private errorValue: string;

  constructor(
    private reqService: LoginReqService,
    private http: HttpClient
  ) {}

  ///////////////////////////////////////////////////////////get user data////////////////////////////////////////////////////////////////////////////
  async getDataUser(
    username: string,
    password: string
    ) {
    if (this.UserData == null) {
      await this.setUserData(
        username,
        password
        );
    }
    return this.UserData;
  }

  /////////////////////////////////////////////////////////////get User without params/////////////////////////////////////////////////////////////////////////////
  getUser(): User{
  return this.UserData;
  }

  //////////////////////////////////////////////////display error message for the user/////////////////////////////////////////////////////////
  getErrorMessage(){
    return this.errorValue;
  }

 ///////////////////////////////////////////////////////////set user data////////////////////////////////////////////////////////////////////////////
  async setUserData(
    username: string,
    password: string
    ): Promise<User> {
    await this.reqService.getServerLoginData(
      username,
      password
      ).then((data: User) => {
      this.UserData = new User(data['user']);
    }),
      (error => {
        console.log('Auslesen gescheitert');
        return this.handleError(error);
      });


    return this.UserData;
  }

  ///////////////////////////////////////////////////get user data with login and registration////////////////////////////////////////////////////////
  async readUserData(
    username: string,
    password: string,
    firstname?: string,
    name?: string,
    gender?: string,
    street?: string,
    houseNumber?: string,
    postalCode?: string,
    city?: string,
    birthday?: string,
    email?: string,
    ): Promise<User> {

      if (
        firstname == null
        && name == null
        && gender == null
        && street == null
        && houseNumber == null
        && postalCode == null
        && city == null
        && birthday == null
        && email == null
        ){
    await this.reqService.getServerLoginData(
      username,
      password
      ).then((data: User) => {
      this.UserData = new User(data['user']);

      console.log(this.UserData);
    }),
      (error => {
        console.log('Auslesen gescheitert');
        return this.handleError(error);
      });

    }else{
      await this.reqService.getServerRegistrationData(
        username,
        password,
        firstname,
        name,
        gender,
        street,
        houseNumber,
        postalCode,
        city,
        birthday,
        email
        ).then((data: User) => {
        this.UserData = new User(data['user']);

        console.log(this.UserData);

    }),
    //comment
    (error => {
      console.log('Auslesen gescheitert');
      return this.handleError(error);
    });

    return this.UserData;
  }
}

/////////////////////////////////////////////analize server Errors////////////////////////////////////
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

















}
