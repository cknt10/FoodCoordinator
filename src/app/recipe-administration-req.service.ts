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
import { User } from './User';

@Injectable({
  providedIn: 'root',
})
export class RecipeAdministrationReqService {
  private errorValue: string;
  private userRecipe: Recipe[] = [];

  constructor(
    private http: HttpClient,
    private searchRequestService: SearchReqService,
    private datePipe: DatePipe
  ) {}

  /////////////////////////////////method to display error message to user///////////////////////////
  getErrorMessageUser(): string {
    return this.errorValue;
  }

  /////////////////////////////////method for current date///////////////////////////
  Date() {
    let creation: string;
    creation = this.datePipe.transform(new Date(), 'yyyy-MM-dd  h:mm:ss');
    return creation;
  }

  /////////////////////////////////Http-Request to send new recipe///////////////////////////
  async getCreateRecipe(
    /*title: string,
    //picture: File,
    servings: number,
    description: string,
    instruction: string,
    duration: number,
    difficulty: string,
    //userId: number,
    keywords: string[],*/
    ingredients: Ingredient[]
  ): Promise<Recipe> {

    let params = new HttpParams()
      /*.set('title', title)
      //.set('picture', picture.toString())
      .set('servings', servings.toString())
      .set('description', description)
      .set('instruction', instruction)
      .set('createionDate', this.Date())
      .set('duration', duration.toString())
      .set('difficulty', difficulty)
      .set('certified', '0')
      .set('lastChange', null);
    //.set('userId', userId.toString())
    //.set('keywords', this.convertRecipeKeywordsArray(keywords).join('|'))
    keywords.forEach((key) => {
      params = params.append('keywords', this.convertRecipeKeyword(key));
    });*/
    //.set('ingredients', ingredientsDescription.join('|'));

    let modifiedIngredients: Object[]=[];
    ingredients.forEach((value,index) => {
      modifiedIngredients[index]=new Object();
      modifiedIngredients[index]={id: value.getId().toString(),amount: value.getAmount().toString(), unit: value.getUnit()};
    });
  
    console.log(modifiedIngredients);

    // modifiedIngredients.forEach((value, i) => {
    //   params = params.append('ingredients', value.join(|));
    // })

     let haha: any = {};
     haha.myArray = JSON.stringify(modifiedIngredients);
     console.log(ingredients);
     console.log(haha.myArray);
    
     
      params = params.append('ingredients', haha.myArray);

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

    let ingredientsID = new Array<string>();
    let ingredientsAmount = new Array<string>();
    let ingredientsUnit = new Array<string>();
    let ingredientsDescription = new Array<string>();
    recipe.getIngredients().forEach((value) => {
      ingredientsID.push(value.getId().toString());
      ingredientsAmount.push(value.getAmount().toString());
      ingredientsUnit.push(value.getUnit());
      ingredientsDescription.push(value.getDescription());
    });

    let params = new HttpParams()
      .set('id', recipe.getId().toString())
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
      .set('userId', recipe.getUserId().toString());
    //.set('keywords', this.convertRecipeKeywordsArray(recipe.getKeywords()).join('|') )
    //.set('ingredients', recipe.getIngredients().join('|'));
    recipe.getKeywords().forEach((key) => {
      params = params.append('keywords', this.convertRecipeKeyword(key));
    });
    //.set('ingredients', ingredientsDescription.join('|'));
    ingredientsDescription.forEach((description) => {
      params = params.append('ingredients', description);
    });

    ingredientsID.forEach((id) => {
      params = params.append('id', id);
    });

    ingredientsAmount.forEach((amount) => {
      params = params.append('amount', amount);
    });

    ingredientsUnit.forEach((unit) => {
      params = params.append('unit', unit);
    });

    //console.log(params);

    const requestLink =
      'http://xcsd.ddns.net/api/backend/recipe/recipechange.php';

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

    //console.log("you're at convert to keywordsId...");

    serverKeywords.forEach((elem1) => {
      elem1;
      tempRecipe.forEach((elem2) => {
        elem2;
        if (elem1.name === elem2) {
          keywordsId.push(elem1.id.toString());
        }
      });
    });
    //console.log(keywordsId);
    return keywordsId;
  }

  /////////////////////////////////convert ingredients to their id///////////////////////////
  convertRecipeIngredientsArray(keywords: Ingredient[]): Ingredient[] {
    let tempRecipe = keywords;
    let ingredientsId = [];
    let serverKeywords = this.searchRequestService.getIngredients();

    //console.log("you're at convert to ingredientsId...");

    serverKeywords.forEach((elem1) => {
      elem1;
      tempRecipe.forEach((elem2) => {
        elem2;
        if (elem1.description === elem2.getDescription()) {
          ingredientsId.push(elem1.id.toString());
        }
      });
    });

    //console.log(ingredientsId);
    return ingredientsId;
  }

  /////////////////////////////////convert keyword to their id///////////////////////////
  convertRecipeKeyword(keywords: string): string {
    let keywordsId: string = '';
    let serverKeywords = this.searchRequestService.getKeywords();

    //console.log("you're at convert to keywordsId...");

    serverKeywords.forEach((elem1) => {
      elem1;
      if (elem1.name === keywords) {
        keywordsId = elem1.id.toString();
      }
    });
    //console.log(keywordsId);
    return keywordsId;
  }

  /////////////////////////////////convert ingredient to their id///////////////////////////
  convertRecipeIngredient(keywords: string): number {
    let tempRecipe = keywords;
    let ingredientsId = 0;
    let serverKeywords = this.searchRequestService.getIngredients();

    //console.log("you're at convert to ingredientsId...");

    serverKeywords.forEach((elem1) => {
      elem1;

      if (elem1.description === tempRecipe) {
        ingredientsId = elem1.id;
      }
    });

    //console.log(ingredientsId);
    return ingredientsId;
  }

  /////////////////////////////////////////get from Server user recipes///////////////////////////////////////////
 async getServerUserRecipe(user: User): Promise<Recipe[]> {
    await this.fetchServerUserRecipe(user).then((data: Recipe) => {
      data['recipes'].forEach((value: Recipe) => {
        this.userRecipe.push(new Recipe(value));
      });
    });
    console.log(this.userRecipe);
    return this.userRecipe;
  }

  /////////////////////////////////Http-Request to get all Cities///////////////////////////
  async fetchServerUserRecipe(user: User): Promise<Recipe> {

    let params = new HttpParams()
    .set('userId', user.getId().toString())

  console.log(params);

    const requestLink = 'http://xcsd.ddns.net/api/backend/recipe/myrecipes.php';

    return this.http
      .get<Recipe>(requestLink, { params: params })
      .pipe(catchError(this.handleError))
      .toPromise();
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
