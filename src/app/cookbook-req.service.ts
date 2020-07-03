import { Injectable } from '@angular/core';
import { AuthenticationService } from './authentication.service';
import { PremiumReqService } from './premium-req.service';
import { Cookbook } from './cookbook';
import {CookbookFormat} from './cookbookFormat'
import { HttpClient, HttpParams } from '@angular/common/http';
import { Payment } from './payment';
import { User } from './User';
import { Recipe } from './recipe';

@Injectable({
  providedIn: 'root'
})
export class CookbookReqService {
  private errorValue: string;
  private cookbook: Cookbook;
  private cookbookFormats: CookbookFormat[] = [];
  private serverPayments: Payment[] = [];

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

   /////////////////////////////////////////get from Server recipe details///////////////////////////////////////////
   async getServerPayment(): Promise<Payment[]> {
    await this.fetchServerPayment()
      .then((data: Payment[]) => {
        data['payment'].forEach((value: Payment) =>{
          this.serverPayments.push(new Payment(value));
        })
        console.log(data['payment']);
      })
      .catch((error) => {
        this.handleErrorPayment(error);
      });
    console.log(this.serverPayments);
    return this.serverPayments;
  }

  /////////////////////////////////Http-Request to get recipe details///////////////////////////
  async fetchServerPayment(): Promise<Payment[]> {
    let params = new HttpParams();

    console.log(params);

    const requestLink = 'http://xcsd.ddns.net/api/backend/order/payment.php';

    return (
      this.http
        .get<Payment[]>(requestLink, { params: params })
        //.pipe(catchError(this.handleError))
        .toPromise()
    );
  }

   /////////////////////////////////////////get from Server recipe details///////////////////////////////////////////
   async getServerCreateCookbook(): Promise<Cookbook> {
    await this.fetchServerPayment()
      .then((data: Payment[]) => {
        data['payment'].forEach((value: Payment) =>{
          this.serverPayments.push(new Payment(value));
        })
        console.log(data['payment']);
      })
      .catch((error) => {
        this.handleErrorCookbookFormats(error);
      });
    console.log(this.serverPayments);
    return this.cookbook;
  }

  /////////////////////////////////Http-Request to get recipe details///////////////////////////
  async fetchServerCreateCookbook(recipe: Recipe[], user: User, cookbook:Cookbook): Promise<Cookbook[]> {
    let params = new HttpParams()


    console.log(params);

    const requestLink = 'http://xcsd.ddns.net/api/backend/order/createorder.php';

    return (
      this.http
        .get<Cookbook[]>(requestLink, { params: params })
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

   ///////////////////////////////////////method to handle error for create cookbook//////////////////////////////////////////////////////////////////
   handleErrorPayment(error: Response) {
    if (error instanceof ErrorEvent) {
      // Client-side errors
      this.errorValue = `Unerwarteter Fehler. Bitte versuchen Sie später noch Mal.`;
    } else {
      // Server-side errors
      if (error.status === 401) {
        this.errorValue = `Die Verbindung zum Server kann nicht aufgebaut werden`;
      }
      if (error.status === 403) {
        this.errorValue = `Es tut uns leid, die Zahlungsmethode funktioniert nicht`;
      }
      if (error.status === 404) {
        this.errorValue = `Es tut uns leid, leider gibt es keine Möglichkeit zu zahlen.`;
      }
      if (error.status === 500) {
        this.errorValue = `Die Verbindung zum Server ist fehlgeschlagen`;
      }
    }
    return this.errorValue;
  }


}
