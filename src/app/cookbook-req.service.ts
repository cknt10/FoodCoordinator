import { Injectable } from '@angular/core';
import { AuthenticationService } from './authentication.service';
import { PremiumReqService } from './premium-req.service';
import { Cookbook } from './cookbook';
import {CookbookFormat} from './cookbookFormat'
import { HttpClient, HttpParams } from '@angular/common/http';
import { Payment } from './payment';
import { Recipe } from './recipe';
import { DatePipe } from '@angular/common';

import { ConstantsService } from './common/globals/constants.service';

@Injectable({
  providedIn: 'root'
})
export class CookbookReqService {
  private errorValue: string;
  private cookbook: Cookbook[] = [];
  private cookbookFormats: CookbookFormat[] = [];
  private serverPayments: Payment[] = [];

  constructor(
    private autenticationReqService: AuthenticationService,
    private premiumReqService: PremiumReqService,
    private http: HttpClient,
    private datePipe: DatePipe,
    private constant: ConstantsService
  ) { }


   /////////////////////////////////////////get from Server recipe details///////////////////////////////////////////
   async getServerCookbookFormats(): Promise<CookbookFormat[]> {
    await this.fetchServerCookbookFormats()
      .then((data: CookbookFormat[]) => {
        data['format'].forEach((value: CookbookFormat) =>{
          this.cookbookFormats.push(new CookbookFormat(value));
        })
        //console.log(data['format']);
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

    const requestLink = this.constant.backendBaseURL + 'api/backend/order/getcookbookformats.php';

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

    const requestLink = this.constant.backendBaseURL + 'api/backend/order/payment.php';

    return (
      this.http
        .get<Payment[]>(requestLink, { params: params })
        //.pipe(catchError(this.handleError))
        .toPromise()
    );
  }

   /////////////////////////////////////////get from Server recipe details///////////////////////////////////////////
   async getServerCreateCookbook(recipe: Recipe[], cookbook:Cookbook): Promise<Cookbook[]> {
    await this.fetchServerCreateCookbook(recipe, cookbook)
      .then((data: Cookbook[]) => {
        data['cookbook'].forEach((value: Cookbook) =>{
          this.cookbook.push(new Cookbook(value));
        })
        console.log(data['cookbook']);
      })
      .catch((error) => {
        this.handleErrorCookbookFormats(error);
      });
    console.log(this.serverPayments);
    return this.cookbook;
  }

  /////////////////////////////////Http-Request to get recipe details///////////////////////////
  async fetchServerCreateCookbook(recipe: Recipe[], cookbook:Cookbook): Promise<Cookbook[]> {

    let giftStatus: number;
    if(cookbook.getGiftStatus() == true){
      giftStatus = 1;
    }else{
      giftStatus = 0;
    }

    let recipeId: string[] = [];

    recipe.forEach(value => {
      recipeId.push(value.getId().toString())
    });


    let params: HttpParams;


    params.set('userId', cookbook.getUserId().toString())
          .set('cbId', cookbook.getId().toString())
          .set('title', cookbook.getDesigntitle())
          .set('dedication', cookbook.getDediction())
          .set('giftstatus', giftStatus.toString())
          .set('amount', cookbook.getAmount().toString())
          .set('orderStatus', cookbook.getOrderStatus())
          .set('creationDate', this.date())
          .set('recipient', cookbook.getRecipient())
          .set('street', cookbook.getStreet())
          .set('housenumber', cookbook.getHouseNumber().toString())
          .set('cityId', cookbook.getCityId().toString())
          .set('paymentMethod', cookbook.getPaymentMethod().toString())
          .set('recipeId', recipeId.join('|'));



    console.log(params);

    const requestLink = this.constant.backendBaseURL + 'api/backend/order/createorder.php';

    return (
      this.http
        .get<Cookbook[]>(requestLink, { params: params })
        //.pipe(catchError(this.handleError))
        .toPromise()
    );
  }

  /////////////////////////////get current day and time//////////////////////////////////////////////////////
  date(): string {
    let startDay: string;
    startDay = this.datePipe.transform(new Date(), 'yyyy-MM-dd  HH:mm:ss');
    return startDay;
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
