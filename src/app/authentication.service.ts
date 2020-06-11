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
  public UserData: User;

  constructor(
    private reqService: LoginReqService,
    private http: HttpClient
  ) {}

  private handleError(error: HttpErrorResponse) {
    console.log(error);

    // return an observable with a user friendly message
    return throwError('Error! something went wrong.');
  }

  ///////////////////////////////////////////////////////////get user data////////////////////////////////////////////////////////////////////////////
  async getUser(
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


      console.log('hallo ' + data['eure Daten']);

      console.log(this.UserData);
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

    (error => {
      console.log('Auslesen gescheitert');
      return this.handleError(error);
    });

    return this.UserData;
  }
}


}
