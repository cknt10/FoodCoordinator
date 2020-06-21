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
  providedIn: 'root'
})
export class RecipeAdministrationReqService {

  private errorValue: string;

  constructor(
    private http: HttpClient, 
    private searchRequestService: SearchReqService
  ) { }

/////////////////////////////////method to display error message to user///////////////////////////
getErrorMessageUser(): string {
  return this.errorValue;
}

getCreateRecipe(recipe: Recipe): Promise<Recipe>{
  console.log('server request with keywords');

  console.log(recipe);

  let params = new HttpParams()
  .set('title', recipe.title)
  .set('picture', recipe.picture.toString())
  .set('servings', recipe.servings.toString())
  .set('description', recipe.description)
  .set('instruction', recipe.instruction)
  .set('createionDate', recipe.createionDate.toString())
  .set('duration', recipe.duration.toString())
  .set('difficulty', recipe.difficulty)
  .set('certified', recipe.certified.toString())
  .set('lastChangeDate', recipe.lastChangeDate.toString())
  .set('userId', recipe.userId.toString())
  .set('keywords', recipe.keywords.join('|'))
  .set('ingredients', recipe.ingredients.join('|'))

  console.log(params);

  const requestLink =
    'http://xcsd.ddns.net/api/backend/recipe/recipeset.php';

  console.log('request finished');

  return this.http
    .get<Recipe>(requestLink, { params: params })
    .pipe(catchError(this.handleError))
    .toPromise();
}

getServerChangeRecipe(recipe: Recipe): Promise<Recipe>{
  console.log('server request with keywords');

  console.log(recipe);

  let params = new HttpParams()
  .set('title', recipe.title)
  .set('picture', recipe.picture.toString())
  .set('servings', recipe.servings.toString())
  .set('description', recipe.description)
  .set('instruction', recipe.instruction)
  .set('createionDate', recipe.createionDate.toString())
  .set('duration', recipe.duration.toString())
  .set('difficulty', recipe.difficulty)
  .set('certified', recipe.certified.toString())
  .set('lastChangeDate', recipe.lastChangeDate.toString())
  .set('userId', recipe.userId.toString())
  .set('keywords', recipe.keywords.join('|'))
  .set('ingredients', recipe.ingredients.join('|'))

  console.log(params);

  const requestLink =
    'http://xcsd.ddns.net/api/backend/recipe/recipechange.php';

  console.log('request finished');

  return this.http
    .get<Recipe>(requestLink, { params: params })
    .pipe(catchError(this.handleError))
    .toPromise();
}

converRecipeKeywordsArray(keywords: string[]): string[]{ 
//converRecipeKeywordArray(recipe: Recipe): Recipe{ 
let tempRecipe=keywords;
let serverKeywords = this.searchRequestService.getIngredients().concat(this.searchRequestService.getKeywords());

console.log("you're at convert to id...")
//console.log(keywords);
//console.log(serverKeywords);

serverKeywords.forEach((elem1, index) => {elem1;
 tempRecipe.forEach((elem2, index) => {elem2;
  //console.log(elem1);
  console.log( elem1.description === elem2);
    if(elem1.description === elem2 || elem1.name === elem2){
      //console.log(elem1.description, elem1.name, elem2);
      tempRecipe[index] = elem1.id.toString();
      console.log(tempRecipe)
    }
  });
});

return tempRecipe;
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
