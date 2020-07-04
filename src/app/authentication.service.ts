import { Injectable } from '@angular/core';
import { LoginReqService } from './login-req.service';
import { User } from './User';
import {PremiumModel} from './premiumModel';
import { Premium } from './premium';

@Injectable({
  providedIn: 'root',
})
export class AuthenticationService {
  private UserData: User;

  private errorValue: string;

  constructor(
    private LoginReqService: LoginReqService,
    ) {}

  ///////////////////////////////////////////////////////////get user data////////////////////////////////////////////////////////////////////////////
  async getDataUser(username: string, password: string) {
    if (this.UserData == null) {
      await this.readUserData(username, password);
    }
    return this.UserData;
  }

  /////////////////////////////////////////////////////////////get User without params/////////////////////////////////////////////////////////////////////////////
  getUser(): User {
      return this.UserData;
  }

  /*setPremium(premiumModel: PremiumModel){
   this.UserData.set
  }*/

  setUser(newUser: User): User {
    this.UserData=newUser;
    return this.UserData;
  }
  //////////////////////////////////////////////////display error message for the user/////////////////////////////////////////////////////////
  getErrorMessage() {
    return this.errorValue;
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
    email?: string
  ): Promise<User> {
    if (
      firstname == null &&
      name == null &&
      gender == null &&
      street == null &&
      houseNumber == null &&
      postalCode == null &&
      city == null &&
      birthday == null &&
      email == null
    ) {
      await this.LoginReqService.getServerLoginData(username, password)
        .then((data: User) => {
          console.log(data['user']);
          console.log(data['premium']);
          if(data['user'].isPremium){
            this.UserData = new User(data['user'], data['premium']);
          }else{
            this.UserData = new User(data['user']);
          }
            console.log(this.UserData.convertAdress());

        })
        .catch((error) => {
          this.handleErrorLogin(error);
        });
        console.log(this.UserData);
    } else {
      await this.LoginReqService.getServerRegistrationData(
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
      )
        .then((data: User) => {
          this.UserData = new User(data['user']);
        })
        .catch((error) => {
          this.handleErrorLogin(error);
        });
    }

    return this.UserData;
  }

  /////////////////////////////////////////////analize server Errors for login////////////////////////////////////
  handleErrorLogin(error: Response) {
    if (error instanceof ErrorEvent) {
      // Client-side errors
      this.errorValue = `Unerwarteter Fehler. Bitte versuchen Sie später noch Mal.`;
    }
    // Server-side errors
    if (error.status === 401) {
      this.errorValue = `Die Verbindung zum Server kann nicht aufgebaut werden`;
    }
    if (error.status === 403) {
      this.errorValue = `Der Benutzername exisitert bereits.`;
    }
    if (error.status === 404) {
      this.errorValue = `Falscher Benutzername oder falsches Passwort`;
    }
    if (error.status === 500) {
      this.errorValue = `Die Verbindung zum Server ist fehlgeschlagen`;
    }
    return this.errorValue;
  }

  /////////////////////////////////////////////analize server Errors for registration////////////////////////////////////
  handleErrorRegistration(error: Response) {
    if (error instanceof ErrorEvent) {
      // Client-side errors
      this.errorValue = `Unerwarteter Fehler. Bitte versuchen Sie später noch Mal.`;
    }
    // Server-side errors
    if (error.status === 401) {
      this.errorValue = `Die Verbindung zum Server kann nicht aufgebaut werden`;
    }
    if (error.status === 403) {
      this.errorValue = `Der Benutzername oder  Email-Adresse ist bereits vergeben.`;
    }
    if (error.status === 404) {
      this.errorValue = `Registirerung fehlgeschalgen. Bitte versuchen Sie es später noch mal`;
    }
    if (error.status === 500) {
      this.errorValue = `Die Verbindung zum Server ist fehlgeschlagen`;
    }
    return this.errorValue;
  }
}
