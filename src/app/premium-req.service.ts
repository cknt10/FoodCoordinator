import { Injectable } from '@angular/core';
import { DatePipe } from '@angular/common';

import { HttpClient, HttpParams } from '@angular/common/http';

import { User } from './User';
import { Recipe } from './recipe';
import { Gift } from './gift';

@Injectable({
  providedIn: 'root',
})
export class PremiumReqService {
  errorValue: string;
  gift: Gift[];
  favouriteRecipe: Recipe[] = [];
  premiumUser: User = null;

  constructor(
    private http: HttpClient,
    private datePipe: DatePipe
  ) {}

  getErrorMessage() {
    return this.errorValue;
  }

  /////////////////////save premium user after login////////////////////////
  getServerPremiumUser(user: any): User {
    this.premiumUser = new User (user);
    return this.premiumUser;
  }

  redeemGift(gift: string) {
    let params = new HttpParams().set('gift', this.premiumUser.getId().toString());

    //console.log(params);

    const requestLink = '';

    return (
      this.http
        .get<User>(requestLink, { params: params })
        //.pipe(catchError(this.handleError))
        .toPromise()
    );
  }

  Date(): string {
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

    const requestLink =
      'http://xcsd.ddns.net/api/backend/recipe/favourites.php';

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
    /*.set('id', recipe.getId()*/;

    console.log(params);

    const requestLink =
      'http://xcsd.ddns.net/api/backend/recipe/setfavourites.php';

    console.log('request finished');

    return (
      this.http
        .get<Recipe>(requestLink, { params: params })
        //.pipe(catchError(this.handleError))
        .toPromise()
    );
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
        this.errorValue = `Es tut uns leid, ${this.premiumUser.getUsername()}, das Geschenk kann nicht ausgestellt werden`;
      }
      if (error.status === 404) {
        this.errorValue = `Es tut uns leid, ${this.premiumUser.getUsername()}, das Geschenk wurde nicht gefunden`;
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
        this.errorValue = `Es tut uns leid, ${this.premiumUser.getUsername()}, unerwarter Fehler `;
      }
      if (error.status === 404) {
        this.errorValue = `Es tut uns leid, ${this.premiumUser.getUsername()}, die Rezepte wurden nicht gefunden`;
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
        this.errorValue = `Es tut uns leid, ${this.premiumUser.getUsername()}, das Rezept kann nicht hinzugefügt werden`;
      }
      if (error.status === 404) {
        this.errorValue = `Es tut uns leid, ${this.premiumUser.getUsername()}, die Rezept wurde nicht gefunden`;
      }
      if (error.status === 500) {
        this.errorValue = `Die Verbindung zum Server ist fehlgeschlagen`;
      }
    }
    return this.errorValue;
  }
}
