import { Injectable } from '@angular/core';
import { DatePipe } from '@angular/common';

import {
  HttpClient,
  HttpParams,
  HttpErrorResponse,
} from '@angular/common/http';
import { throwError } from 'rxjs';
import { catchError } from 'rxjs/operators';

import { AuthenticationService } from './authentication.service';
import { User } from './User';

@Injectable({
  providedIn: 'root'
})
export class PremiumReqService {

  errorValue: string;
  gift: string[];

  constructor(
    private http: HttpClient,
    private authenticationReqService: AuthenticationService,
    private datePipe: DatePipe
  ) { }

  redeemGift(gift: string){
      console.log('server request with keywords');
  
      let params = new HttpParams()
        .set('gift', this.authenticationReqService.getUser().toString());
        
      //console.log(params);
  
      const requestLink = '';
  
      console.log('request finished');
  
      return this.http
        .get<User>(requestLink, { params: params })
        .pipe(catchError(this.handleError))
        .toPromise();
    }

  Date():string {
    let startDay: string;
    startDay = this.datePipe.transform(new Date(), 'yyyy-MM-dd  HH:mm:ss');
    return startDay;
  }
   /////////////////////////////////method to get keywords as proposition///////////////////////////
   async getServerGift(): Promise<string[]> {
    await this.fetchServerGift().then((data) => {
      this.gift = data['gift'];
    });
    return this.gift;
  }

  /////////////////////////////////Http-Request method to get ingredients as proposition///////////////////////////
  async fetchServerGift() {
    const requestLink = ''; //noch kein link

    return this.http
      .get<string>(requestLink)
      .pipe(catchError(this.handleError))
      .toPromise();
  }


  handleError(error: HttpErrorResponse) {
    let errorMessage = 'Unbekannter Fehler!';
    if (error.error instanceof ErrorEvent) {
      // Client-side errors
      errorMessage = `Error: ${error.error.message}`;
    } else {
      // Server-side errors
      if (error.status == 401) {
        this.errorValue = `Die Verbindung zum Server kann nicht aufgebaut werden`;
      }
      if (error.status == 403) {
        this.errorValue = `Keine Ahnung.`;
      }
      if (error.status == 404) {
        this.errorValue = `Leider wurden keine Geschenke gefunden.`;
      }
      if (error.status == 500) {
        this.errorValue = `Die Verbindung zum Server ist fehlgeschlagen.`;
      }
      errorMessage = `Error Code: ${error.status}\nMessage: ${error.message}`;
    }
    return throwError(errorMessage);
  }


}
