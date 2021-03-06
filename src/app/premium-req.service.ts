import { Injectable } from '@angular/core';
import { DatePipe } from '@angular/common';

import { HttpClient, HttpParams } from '@angular/common/http';

import { User } from './User';
import { Recipe } from './recipe';
import { Gift } from './gift';
import { PremiumModel } from './premiumModel';
import {AuthenticationService} from '././authentication.service';
import { Premium } from './premium';

import { ConstantsService } from './common/globals/constants.service';


@Injectable({
  providedIn: 'root',
})
export class PremiumReqService {
  private errorValue: string;
  private gift: Gift[];
  private favouriteRecipe: Recipe[] = [];
  private premiumModels: PremiumModel[] = [];
  private premiumUser: User = null;

  constructor(
    private http: HttpClient,
    private datePipe: DatePipe,
    private authenticationService: AuthenticationService,
    private constant: ConstantsService
  ) {}

  /////////////////////////////////errror Message to display on user///////////////////////
  getErrorMessage() {
    return this.errorValue;
  }

  ////////////////////////////HTTP-Request to redeem gift/////////////////////////////////
  redeemGift(gift: string, premium: User) {
    let params = new HttpParams().set('gift', premium.getId().toString());

    //console.log(params);

    const requestLink = '';

    return (
      this.http
        .get<User>(requestLink, { params: params })
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
  /////////////////////////////////method to get keywords as proposition///////////////////////////
  async getServerGift(): Promise<Gift[]> {
    await this.fetchServerGift()
      .then((data) => {
        this.gift = data['gift'];
      })
      .catch((error) => {
        this.handleErrorGift(error);
      });
    return this.gift;
  }

  /////////////////////////////////////////////////save changed recipe from server response ///////////////////////////////////
  async getServerFavouriteRecipe(): Promise<Recipe[]> {
    await this.fetchServerFavouriteRecipe()
      .then((data: Recipe) => {
        //have to controle !
        data['favourites'].forEach((value: Recipe) => {
          this.favouriteRecipe.push(new Recipe(value));
        });
      })
      .catch((error) => {
        this.handleErrorFavouriteRecipe(error);
      });
    console.log(this.favouriteRecipe);
    return this.favouriteRecipe;
  }

   /////////////////////////////////////////////////save changed recipe from server response ///////////////////////////////////
   async getServerSetFavouriteRecipe(recipe: Recipe): Promise<Recipe[]> {
    await this.fetchServerSetFavouriteRecipe(recipe)
      .then((data: Recipe) => {
        //have to controle !
        data['favourites'].forEach((value: Recipe) => {
          this.favouriteRecipe.push(new Recipe(value));
        });
      })
      .catch((error) => {
        this.handleErrorSetFavouriteRecipe(error);
      });
    console.log(this.favouriteRecipe);
    return this.favouriteRecipe;
  }


  /////////////////////////////////Http-Request method to get ingredients as proposition///////////////////////////
  async fetchServerGift(): Promise<Gift> {
    const requestLink = ''; //noch kein link

    return (
      this.http
        .get<Gift>(requestLink)
        //.pipe(catchError(this.handleError))
        .toPromise()
    );
  }

  /////////////////////////////////Http-Request to get favourite recipe///////////////////////////
  fetchServerFavouriteRecipe(): Promise<Recipe> {
    console.log('server request with keywords');

    let params = new HttpParams();
    //.set('id', user.getId().toString());

    console.log(params);

    const requestLink = this.constant.backendBaseURL + 'api/backend/recipe/favourites.php';

    console.log('request finished');

    return (
      this.http
        .get<Recipe>(requestLink, { params: params })
        //.pipe(catchError(this.handleError))
        .toPromise()
    );
  }

  /////////////////////////////////Http-Request to get favourite recipe///////////////////////////
  fetchServerSetFavouriteRecipe(recipe: Recipe): Promise<Recipe> {
    console.log('server request with keywords');

    let params = new HttpParams()
    .set('id', recipe.getId().toString());

    console.log(params);

    const requestLink = this.constant.backendBaseURL + 'api/backend/recipe/setfavourites.php';

    console.log('request finished');

    return (
      this.http
        .get<Recipe>(requestLink, { params: params })
        //.pipe(catchError(this.handleError))
        .toPromise()
    );
  }
///////////////////////////////////////get premium modells from database//////////////////////////////////////////////////////////////////
 async getPremium(): Promise<PremiumModel[]>{

  const requestLink = this.constant.backendBaseURL + 'api/backend/order/premium.php'

 await  this.http.get<PremiumModel[]>(requestLink).toPromise().then((data: PremiumModel[]) => {
//console.log(data);
  data['premium'].forEach((value: PremiumModel) => {
    this.premiumModels.push(new PremiumModel(value));
  });
})
.catch((error) => {
  this.handleErrorPremiumModel(error);
});
//console.log(this.premiumModels);
return this.premiumModels;
}

//////////////////////////////////////set premium //////////////////////////////////////////////////////////////////
async setPremium (user: User): Promise<string>{

  let values = {
    'premiumId': user.getPremiumUser().getPremiumModel().getId(),
    'userId': user.getId(),
    'paymentMethode': user.getPremiumUser().getPaymentMethodId(),
    'date': this.date()
  }

  const requestLink = this.constant.backendBaseURL + 'api/backend/user/setpremium.php'
let message: string ='';
  await  this.http.post<string>(requestLink, values).toPromise().then((data: string) => {

 })
 .catch((error) => {
   this.handleErrorPremiumModel(error);
 });
 console.log
 return message;
 }
  ///////////////////////////////////////method to handle error for gift//////////////////////////////////////////////////////////////////
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
        this.errorValue = `Es tut uns leid, das Geschenk kann nicht ausgestellt werden`;
      }
      if (error.status === 404) {
        this.errorValue = `Es tut uns leid, das Geschenk wurde nicht gefunden`;
      }
      if (error.status === 500) {
        this.errorValue = `Die Verbindung zum Server ist fehlgeschlagen`;
      }
    }
    return this.errorValue;
  }

  ///////////////////////////////////////method to handle error for favourite recipe//////////////////////////////////////////////////////////////////
  handleErrorFavouriteRecipe(error: Response) {
    if (error instanceof ErrorEvent) {
      // Client-side errors
      this.errorValue = `Unerwarteter Fehler. Bitte versuchen Sie später noch Mal.`;
    } else {
      // Server-side errors
      if (error.status === 401) {
        this.errorValue = `Die Verbindung zum Server kann nicht aufgebaut werden`;
      }
      if (error.status === 403) {
        this.errorValue = `Es tut uns leid,  unerwarter Fehler `;
      }
      if (error.status === 404) {
        this.errorValue = `Es tut uns leid,  die Rezepte wurden nicht gefunden`;
      }
      if (error.status === 500) {
        this.errorValue = `Die Verbindung zum Server ist fehlgeschlagen`;
      }
    }
    return this.errorValue;
  }

   ///////////////////////////////////////method to handle error for set favourite recipe//////////////////////////////////////////////////////////////////
   handleErrorSetFavouriteRecipe(error: Response) {
    if (error instanceof ErrorEvent) {
      // Client-side errors
      this.errorValue = `Unerwarteter Fehler. Bitte versuchen Sie später noch Mal.`;
    } else {
      // Server-side errors
      if (error.status === 401) {
        this.errorValue = `Die Verbindung zum Server kann nicht aufgebaut werden`;
      }
      if (error.status === 403) {
        this.errorValue = `Es tut uns leid, das Rezept kann nicht hinzugefügt werden`;
      }
      if (error.status === 404) {
        this.errorValue = `Es tut uns leid, die Rezept wurde nicht gefunden`;
      }
      if (error.status === 500) {
        this.errorValue = `Die Verbindung zum Server ist fehlgeschlagen`;
      }
    }
    return this.errorValue;
  }

    ///////////////////////////////////////method to handle error for get premium modells//////////////////////////////////////////////////////////////////
  handleErrorPremiumModel(error: Response) {
    if (error instanceof ErrorEvent) {
      // Client-side errors
      this.errorValue = `Unerwarteter Fehler. Bitte versuchen Sie später noch Mal.`;
    } else {
      // Server-side errors
      if (error.status === 401) {
        this.errorValue = `Die Verbindung zum Server kann nicht aufgebaut werden`;
      }
      if (error.status === 403) {
        this.errorValue = `Leider haben haben Sie kein Zugriff auf die Premium Modelle`;
      }
      if (error.status === 404) {
        this.errorValue = `Leider wurden keine Premium Modelle gefunden`;
      }
      if (error.status === 500) {
        this.errorValue = `Die Verbindung zum Server ist fehlgeschlagen`;
      }
    }
    return this.errorValue;
  }
}
