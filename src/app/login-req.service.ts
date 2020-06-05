import { Injectable } from '@angular/core';
import { HttpClient, HttpHeaders } from '@angular/common/http';
import { Observable } from 'rxjs';
import { User } from './User';


@Injectable({
  providedIn: 'root'
})
export class LoginReqService {

  constructor(
    private http: HttpClient
  ) { }

///////////////////////////////////////HTTP-Request method//////////////////////////////////////////////////////////////////
 getServerLoginData(): Promise<User>{

console.log("frage Server an");

const httpOptions = {
  headers: new HttpHeaders({
    'Content-Type': 'application/json',
    'username': 'test',
    'password': '123456'
  })
};

const anfrageLink='http://xcsd.ddns.net/api/backend/login/login.php';

//to-post including incoming parameter: username, password

console.log("request finished");

return this.http.get<User>(anfrageLink/*, httpOptions*/).toPromise();
}



}
