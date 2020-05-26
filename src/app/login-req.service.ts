import { Injectable } from '@angular/core';
import { HttpClient, HttpHeaders } from '@angular/common/http';
import { Observable } from 'rxjs';
import { User } from './User';

@Injectable({
  providedIn: 'root'
})
export class LoginReqService {

  private serverUrl = '../api/backend/login';

  constructor(
    private http: HttpClient
  ) { }


public getServerLoginData(): Observable<User>{

  console.log("frage Server an");

const httpOptions = {
  headers: new HttpHeaders({
    'Content-Type': 'application/json'
  })

};

  return this.http.get<User>(`${this.serverUrl}/login.php`, httpOptions);
}


}
