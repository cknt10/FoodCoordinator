import { Injectable } from '@angular/core';
import { User } from './User';
import { HttpClient } from '@angular/common/http';

import { AuthenticationService } from './authentication.service';

import { ConstantsService } from './common/globals/constants.service';


@Injectable({
  providedIn: 'root'
})
export class UserManagementServiceReqService {

  private UserData: User;

  private errorValue: string;


  constructor(private userAuthentication: AuthenticationService,private http: HttpClient, private constant: ConstantsService) { }

getUserData(){
  return this.UserData;
}

  getErrorMessage() {
    return this.errorValue;
  }

  ///////////////////////////////////////////////////get user data with login and registration////////////////////////////////////////////////////////
  async changeUserData(
    id: number,
    username: String,
    password: String,
    firstname: String,
    name: String,
    gender: String,
    street: String,
    houseNumber: String,
    postalCode: number,
    city: String,
    birthday: Date,
    email: String,
    picture: String
  ): Promise<User> {

    let values={

      'id': id,
      'firstname': firstname,
      'name': name,
      'gender': gender,
      'street': street,
      'houseNumber': houseNumber,
      'postalCode': postalCode,
      'city': city,
      'birthday': birthday,
      'username': username,
      'email': email,
      'password': password,
      'picture': picture

    }


    const requestLink = this.constant.backendBaseURL + 'api/backend/login/usermanagment.php';

  await this.http
    .post<User>(requestLink, values)
    .toPromise().then((data: User) => {
      this.UserData = new User(data['user']);
      this.userAuthentication.setUser(this.UserData);
    })
    .catch((error) => {
      this.handleErrorUserChange(error);

    });

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
