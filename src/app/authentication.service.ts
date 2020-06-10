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
  /////////////////////////////////////////////////////////////////////////////////////////////////////////
  // set data from json to new user
  /*async setUserData(): Promise<User> {
    await this.reqService.getServerLoginData().then((data: User) => {
      this.UserData = new User(data['user']);

      console.log(this.UserData);
    }),
      (error) => {
        console.log('Dat mit der Entfaltung klappt noch nich so gut');
      };


    return this.UserData;
  }*/
  /////////////////////////////////////////////////////////////////////////////////////////////////////////
  //get user data
  async getUser(username: string, password: string ) {
    if (this.UserData == null) {
      await this.setUserData(username, password);
    }
    return this.UserData;
  }


  async setUserData(username: string, password: string): Promise<User> {
    await this.reqService.postServerLoginData(username,password).then((data: User) => {
      this.UserData = new User(data['user']);

      console.log(data['eure Daten']);

      console.log(this.UserData);
    }),
      (error => {
        console.log('Auslesen gescheitert');
        return this.handleError(error);
      });


    return this.UserData;
  }


}
