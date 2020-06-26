import { Injectable } from '@angular/core';
import { DatePipe } from '@angular/common';

import {
  HttpClient,
  HttpParams,
  HttpErrorResponse,
} from '@angular/common/http';
import { throwError } from 'rxjs';
import { catchError } from 'rxjs/operators';

import { Recipe } from './recipe';
import { SearchReqService } from './search-req.service';
import { Ingredient } from './ingredient';


@Injectable({
  providedIn: 'root',
})
export class RecipeAdministrationReqService {
  private errorValue: string;

  constructor(
    private http: HttpClient,
    private searchRequestService: SearchReqService,
    private datePipe: DatePipe
  ) {}

  /////////////////////////////////method to display error message to user///////////////////////////
  getErrorMessageUser(): string {
    return this.errorValue;
  }

  Date(){
    let creation = this.datePipe.transform( new Date(),'yyyy-MM-dd  h:mm:ss');
    return creation;
  }

  /////////////////////////////////Http-Request to send new recipe///////////////////////////
  async getCreateRecipe(
    title: string,
    //picture: File,
    servings: number,
    description: string,
    instruction: string,
    duration: number,
    difficulty: string,
    userId: number,
    keywords: string[],
    ingredients: Ingredient[]
  ): Promise<Recipe> {
    console.log('server request with keywords');

    console.log(title, servings, description, instruction,  duration, difficulty, userId, keywords, ingredients);

    this.Date();

    console.log(this.Date());

    let params = new HttpParams()
      .set('title', title)
      //.set('picture', picture.toString())
      .set('servings', servings.toString())
      .set('description', description)
      .set('instruction', instruction)
      .set('createionDate', this.Date())
      .set('duration', duration.toString())
      .set('difficulty', difficulty)
      .set('certified', null)
      .set('lastChange', null)
      .set('userId', userId.toString())
      .set('keywords', this.convertRecipeKeywordsArray(keywords).join('|'));


      for (let i = 0; i < ingredients.length-1; i++) {
        params = params.append('id', ingredients[i].getId().toString());
        params = params.append('amount', ingredients[i].getAmount().toString());
        params = params.append('unit', ingredients[i].getUnit());
      }
      

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
      .set('ingredients', recipe.getIngredients().join('|'));

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
  convertRecipeIngredientsArray(keywords: Ingredient[]): Ingredient[] {
    let tempRecipe = keywords;

    let ingredientsId = [];
    let serverKeywords = this.searchRequestService.getIngredients();

    console.log("you're at convert to ingredientsId...");

    serverKeywords.forEach((elem1) => {
      elem1;
      tempRecipe.forEach((elem2) => {
        elem2;
        if (elem1.description === elem2.getDescription()) {
          ingredientsId.push(elem1.id.toString());
        }
      });
    });

    console.log(ingredientsId);
    return ingredientsId;
  }


  convertRecipeIngredient(keywords: string): number {
    let tempRecipe = keywords;

    let ingredientsId = 0;
    let serverKeywords = this.searchRequestService.getIngredients();

    console.log("you're at convert to ingredientsId...");

    serverKeywords.forEach((elem1) => {
      elem1;

        if (elem1.description === tempRecipe) {
          ingredientsId = elem1.id;
        }

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
