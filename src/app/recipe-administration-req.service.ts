import { Injectable } from '@angular/core';

import {
  HttpClient,
  HttpParams,
  HttpErrorResponse,
} from '@angular/common/http';
import { throwError } from 'rxjs';
import { catchError } from 'rxjs/operators';

import { User } from './user';
import { Recipe } from './recipe';
import { SearchReqService } from './search-req.service';

@Injectable({
  providedIn: 'root',
})
export class RecipeAdministrationReqService {
  private errorValue: string;

  constructor(
    private http: HttpClient,
    private searchRequestService: SearchReqService
  ) {}

  /////////////////////////////////method to display error message to user///////////////////////////
  getErrorMessageUser(): string {
    return this.errorValue;
  }

  /////////////////////////////////Http-Request to send new recipe///////////////////////////
  getCreateRecipe(
    title: string,
    picture: File,
    servings: number,
    description: string,
    instruction: string,
    //createionDate: Date,
    duration: number,
    difficulty: string,
    userId: number,
    keywords: string[],
    ingredients: string[]
  ): Promise<Recipe> {
    console.log('server request with keywords');

    let params = new HttpParams()
      .set('title', title)
      .set('picture', picture.toString())
      .set('servings', servings.toString())
      .set('description', description)
      .set('instruction', instruction)
      //.set('createionDate', createionDate.toString())
      .set('duration', duration.toString())
      .set('difficulty', difficulty)
      .set('userId', userId.toString())
      .set('keywords', this.convertRecipeKeywordsArray(keywords).join('|'))
      .set('ingredients', this.convertRecipeIngredientsArray(ingredients).join('|'));

    console.log(params);

    const requestLink = 'http://xcsd.ddns.net/api/backend/recipe/recipeset.php';

    console.log('request finished');

    return this.http
      .get<Recipe>(requestLink, { params: params })
      .pipe(catchError(this.handleError))
      .toPromise();
  }

  /////////////////////////////////Http-Request to change recipe///////////////////////////
  getServerChangeRecipe(recipe: Recipe): Promise<Recipe> {
    console.log('server request with keywords');

    //console.log(recipe);

    let params = new HttpParams()
      .set('title', recipe.getTitle())
      .set('picture', recipe.picture.toString())
      .set('servings', recipe.getServings().toString())
      .set('description', recipe.getDescription())
      .set('instruction', recipe.getInstruction())
      .set('createionDate', recipe.getCreateionDate().toString())
      .set('duration', recipe.getDuration().toString())
      .set('difficulty', recipe.getDifficulty())
      .set('certified', recipe.getCertified().toString())
      .set('lastChangeDate', recipe.getLastChangeDate().toString())
      .set('userId', recipe.getUserId().toString())
      .set('keywords', this.convertRecipeKeywordsArray(recipe.getKeywords()).join('|') )
      .set('ingredients', this.convertRecipeKeywordsArray(recipe.getIngredients()).join('|'));

    //console.log(params);

    const requestLink = 'http://xcsd.ddns.net/api/backend/recipe/recipechange.php';

    console.log('request finished');

    return this.http
      .get<Recipe>(requestLink, { params: params })
      .pipe(catchError(this.handleError))
      .toPromise();
  }

  /////////////////////////////////convert keywords to their id///////////////////////////
  convertRecipeKeywordsArray(keywords: string[]): string[] {
    let tempRecipe = keywords;
    let keywordsId = [];
    let serverKeywords = this.searchRequestService.getKeywords();

    console.log("you're at convert to keywordsId...");

    serverKeywords.forEach((elem1) => {
      elem1;
      tempRecipe.forEach((elem2) => {
        elem2;
        if (elem1.name === elem2) {
          keywordsId.push(elem1.id.toString());
        }
      });
    });
    console.log(keywordsId);
    return keywordsId;
  }

  /////////////////////////////////convert ingredients to their id///////////////////////////
  convertRecipeIngredientsArray(keywords: string[]): string[] {
    let tempRecipe = keywords;
    let ingredientsId = [];
    let serverKeywords = this.searchRequestService.getIngredients();

    console.log("you're at convert to ingredientsId...");

    serverKeywords.forEach((elem1) => {
      elem1;
      tempRecipe.forEach((elem2) => {
        elem2;
        if (elem1.description === elem2) {
          ingredientsId.push(elem1.id.toString());
        }
      });
    });

    console.log(ingredientsId);
    return ingredientsId;
  }

  /////////////////////////////////analyze error and get understanable message to user///////////////////////////
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
        this.errorValue = `Keine Suchbegriffe eingegeben.`;
      }
      if (error.status == 404) {
        this.errorValue = `Leider wurde das Rezept nicht gefunden.`;
      }
      if (error.status == 500) {
        this.errorValue = `Die Verbindung zum Server wurde fehlgeschlagen`;
      }
      errorMessage = `Error Code: ${error.status}\nMessage: ${error.message}`;
    }
    return throwError(errorMessage);
  }
}
