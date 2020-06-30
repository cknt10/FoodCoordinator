import { Injectable } from '@angular/core';
import { AuthenticationService } from './authentication.service';
import { PremiumReqService } from './premium-req.service';
import { Cookbook } from './cookbook';
import {CookbookFormat} from './cookbookFormat'
import { HttpClient, HttpParams } from '@angular/common/http';

@Injectable({
  providedIn: 'root'
})
export class CookbookReqService {
  private errorValue: string;
  private cookbook: Cookbook;
  private cookbookFormats: CookbookFormat[] = [];

  constructor(
    private autenticationReqService: AuthenticationService, 
    private premiumReqService: PremiumReqService, 
    private http: HttpClient
  ) { }

  
   /////////////////////////////////////////get from Server recipe details///////////////////////////////////////////
   async getServerCookbookFormats(): Promise<CookbookFormat[]> {
    await this.fetchServerCookbookFormats()
      .then((data: CookbookFormat[]) => {
        data['format'].forEach((value: CookbookFormat) =>{
          this.cookbookFormats.push(new CookbookFormat(value));
        })
        console.log(data['format']);
      })
      .catch((error) => {
        this.handleErrorCookbookFormats(error);
      });
    console.log(this.cookbookFormats);
    return this.cookbookFormats;
  }

  /////////////////////////////////Http-Request to get recipe details///////////////////////////
  async fetchServerCookbookFormats(): Promise<CookbookFormat[]> {
    let params = new HttpParams();

    console.log(params);

    const requestLink = 'http://xcsd.ddns.net/api/backend/order/getcookbookformats.php';

    return (
      this.http
        .get<CookbookFormat[]>(requestLink, { params: params })
        //.pipe(catchError(this.handleError))
        .toPromise()
    );
  }


   ///////////////////////////////////////method to handle error for get server cookbook formats//////////////////////////////////////////////////////////////////
   handleErrorCookbookFormats(error: Response) {
    if (error instanceof ErrorEvent) {
      // Client-side errors
      this.errorValue = `Unerwarteter Fehler. Bitte versuchen Sie später noch Mal.`;
    } else {
      // Server-side errors
      if (error.status === 401) {
        this.errorValue = `Die Verbindung zum Server kann nicht aufgebaut werden`;
      }
      if (error.status === 403) {
        this.errorValue = `Es tut uns leid, das Format kann nicht erstellt werden`;
      }
      if (error.status === 404) {
        this.errorValue = `Es tut uns leid, leider gibt es das Format nicht.`;
      }
      if (error.status === 500) {
        this.errorValue = `Die Verbindung zum Server ist fehlgeschlagen`;
      }
    }
    return this.errorValue;
  }

  ///////////////////////////////////////method to handle error for create cookbook//////////////////////////////////////////////////////////////////
  handleErrorCookbook(error: Response) {
    if (error instanceof ErrorEvent) {
      // Client-side errors
      this.errorValue = `Unerwarteter Fehler. Bitte versuchen Sie später noch Mal.`;
    } else {
      // Server-side errors
      if (error.status === 401) {
        this.errorValue = `Die Verbindung zum Server kann nicht aufgebaut werden`;
      }
      if (error.status === 403) {
        this.errorValue = `Es tut uns leid, das Kochbuch kann nicht erstellt werden`;
      }
      if (error.status === 404) {
        this.errorValue = `Es tut uns leid, leider gibt es das Rezept nicht.`;
      }
      if (error.status === 500) {
        this.errorValue = `Die Verbindung zum Server ist fehlgeschlagen`;
      }
    }
    return this.errorValue;
  }


}
