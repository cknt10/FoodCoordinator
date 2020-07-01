import { Injectable } from '@angular/core';
import { User } from './User';
import {
  HttpClient,
  HttpParams,
} from '@angular/common/http';

import { AuthenticationService } from './authentication.service';
import { timeStamp } from 'console';

@Injectable({
  providedIn: 'root'
})
export class UserManagementServiceReqService {

  private UserData: User;

  private errorValue: string;


  constructor(private userAuthentication: AuthenticationService,private http: HttpClient) { }

getUserData(){
  return this.UserData;
}

  getErrorMessage() {
    return this.errorValue;
  }

  ///////////////////////////////////////////////////get user data with login and registration////////////////////////////////////////////////////////
  async readUserData(
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

  const requestLink = 'http://xcsd.ddns.net/api/backend/login/register.php';

  await this.http
    .get<User>(requestLink, { params: params })
    .toPromise().then((data: User) => {
      this.UserData = new User(data['user']);
    })
    .catch((error) => {
      this.handleErrorUserChange(error);
    });
    this.userAuthentication.setUser(this.UserData);
    return this.UserData;
  }

  /////////////////////////////////////////////analize server Errors for login////////////////////////////////////
  handleErrorUserChange(error: Response) {
    if (error instanceof ErrorEvent) {
      // Client-side errors
      this.errorValue = `Unerwarteter Fehler. Bitte versuchen Sie später noch Mal.`;
    }
    // Server-side errors
    if (error.status === 401) {
      this.errorValue = `Die Verbindung zum Server kann nicht aufgebaut werden`;
    }
    if (error.status === 403) {
      this.errorValue = `Überprüfe nochmal, ob deine Informationen auch vollständig sind.`;
    }
    if (error.status === 404) {
      this.errorValue = `Der Server anwortet gerade nicht, probiere es später nochmal.`;
    }
    if (error.status === 500) {
      this.errorValue = `Die Verbindung zum Server ist fehlgeschlagen`;
    }
    return this.errorValue;
  }

}
