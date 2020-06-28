import { Injectable } from '@angular/core';
import { DatePipe } from '@angular/common';

import {
  HttpClient,
  HttpParams,
} from '@angular/common/http';

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

  getErrorMessage(){
    return this.errorValue;
  }

  redeemGift(gift: string){
  
      let params = new HttpParams()
        .set('gift', this.authenticationReqService.getUser().toString());
        
      //console.log(params);
  
      const requestLink = '';
  
      return this.http
        .get<User>(requestLink, { params: params })
        //.pipe(catchError(this.handleError))
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
    }).catch (error => {
      this.handleErrorGift(error);
      });
    return this.gift;
  }

  /////////////////////////////////Http-Request method to get ingredients as proposition///////////////////////////
  async fetchServerGift() {
    const requestLink = ''; //noch kein link

    return this.http
      .get<string>(requestLink)
      //.pipe(catchError(this.handleError))
      .toPromise();
  }

  ///////////////////////////////////////method to handle error for cities//////////////////////////////////////////////////////////////////
  handleErrorGift(error: Response) {
    if (error instanceof ErrorEvent) {
      // Client-side errors
      this.errorValue = `Unerwarteter Fehler. Bitte versuchen Sie später noch Mal.`;
    } else {
      // Server-side errors
      if (error.status === 401) {
        this.errorValue = `Die Verbindung zum Server kann nicht aufgebaut werden`;
      }
      if (error.status === 403) {
        this.errorValue = `Es tut uns leid, ${this.authenticationReqService.getUser().getUsername()}, das Geschenk kann nicht ausgestellt werden`;
      }
      if (error.status === 404) {
        this.errorValue = `Es tut uns leid, ${this.authenticationReqService.getUser().getUsername()}, das Geschenk wurde nicht gefunden`;
      }
      if (error.status === 500) {
        this.errorValue = `Die Verbindung zum Server ist fehlgeschlagen`;
      }
    }
    return this.errorValue;
  }


}
