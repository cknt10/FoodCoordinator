import { Injectable } from '@angular/core';
import { HttpClient, HttpHeaders } from '@angular/common/http';
import { Observable } from 'rxjs';
import { User } from './User';

@Injectable({
  providedIn: 'root'
})
export class LoginReqService {

  //private serverUrl = '../../api/backend/login';

  constructor(
    private http: HttpClient
  ) { }


getServerLoginData(){

  console.log("frage Server an");

const httpOptions = {
  headers: new HttpHeaders({
    'Content-Type': 'application/json',
    'username': 'test',
    'password': '123456'
  })

};

  //return  this.http.get(`${this.serverUrl}/login.php`, httpOptions);
  console.log('Du bist jetzt hier');
  //console.log(this.http.get('http://xcsd.ddns.net/api/backend/login/login.php' /*, httpOptions*/));
  return  this.http.get('http://xcsd.ddns.net/api/backend/login/login.php' /*, httpOptions*/);
}





}
