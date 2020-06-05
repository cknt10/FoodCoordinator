import { Injectable } from '@angular/core';
import { LoginReqService } from './login-req.service';
import { Subscription, Observable,throwError  } from 'rxjs';
import { User } from './User';
import { map, catchError } from 'rxjs/operators';
import { HttpClient, HttpErrorResponse, HttpParams } from '@angular/common/http';

@Injectable({
  providedIn: 'root'
})
export class AuthenicationService {


private UserData: User;


  constructor(
    private reqService: LoginReqService, 
    private http: HttpClient
    ) {}

  private handleError(error: HttpErrorResponse) {
    console.log(error);

    // returns an observable with a user friendly message
    return throwError('Error! something went wrong.');
  }

  ///////////////////////////////////////////////////////////////////////////////////////////////////
setUserData(): Observable<User>{

  console.log('cover data out of httpRequest-method from login.service');

  return this.reqService.getServerLoginData().pipe(
    map((res) => {
      this.UserData = res['user'];
      return this.UserData;
  }),
  catchError(this.handleError));

}
}
