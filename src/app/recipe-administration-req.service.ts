import { Injectable } from '@angular/core';
import { DatePipe } from '@angular/common';

import { HttpClient, HttpParams, HttpHeaders } from '@angular/common/http';

import { Recipe } from './recipe';
import { SearchReqService } from './search-req.service';
import { Ingredient } from './ingredient';
import { User } from './User';
import { Ratings } from './ratings';
import { Nutrient } from './nutrient';

import { ConstantsService } from './common/globals/constants.service';


@Injectable({
  providedIn: 'root',
})
export class RecipeAdministrationReqService {
  private errorValue: string;
  private userRecipes: Recipe[] = [];
  private userRecipe: Recipe;
  private recipeRatings: Ratings[] = [];

  constructor(
    private http: HttpClient,
    private searchRequestService: SearchReqService,
    private datePipe: DatePipe,
    private constant: ConstantsService
  ) {}

  /////////////////////////////////method to display error message to user///////////////////////////
  getErrorMessage(): string {
    return this.errorValue;
  }

  getRecipeDetails(): Recipe {
    return this.userRecipe;
  }

  getDifficulty(): string[]{
    let difficulty: string[] =  
    ['einfach', 
      'mittel', 
      'schwer'];
    return difficulty;
  }

  getUnit(): string[]{
    let unit: string[] = 
    ['l', 
    'dl', 
    'cl',
    'ml',
    'tasse',
    'g',
    'mg',
    'dag',
    'kg',
    'pfund',
    'bund',
    'tropfen',
    'spitzer',
    'blatt',
    'tl',
    'bl',
    'el',
    'msp',
    'prise',
    'dose',
    'karton',
    'becher',
    'stk',
    'packung',
    'päckchen',
    'tsp'
  ];
    return unit;
  }

  /////////////////////////////////Http-Request to send new recipe///////////////////////////
  async getCreateRecipe(
    title: string,
    picture: string,
    servings: number,
    description: string,
    instruction: string,
    duration: number,
    difficulty: string,
    userId: number,
    keywords: string[],
    ingredients: Ingredient[]
  ): Promise<string> {

    let modifiedIngredients: Object[] = [];
    // ingredients.forEach((value, index) => {
    //   modifiedIngredients[index] = new Object();
    //   modifiedIngredients[index] = {
    //     id: value.getId().toString(),
    //     amount: value.getAmount().toString(),
    //     unit: value.getUnit(),
    //   };
    // });

    let ingr = new Array();
    ingredients.forEach((value, index) => {
      ingr.push({
        'id': value.getId(),
        'amount': value.getAmount(),
        'unit': value.getUnit()
      })
    });

    console.log(modifiedIngredients);

    let jsonFormat: any = {};
    jsonFormat.myArray = JSON.stringify(modifiedIngredients);
    console.log(ingredients);
    console.log(jsonFormat.myArray);
    console.log(this.convertRecipeKeywordsArray(keywords).join('|'));

      let values = {
        'title': title,
        'picture': picture,
        'servings': servings.toString(),
        'description': description,
        'instruction': instruction,
        'creationDate': this.date(),
        'duration': duration.toString(),
        'difficulty': difficulty,
        'certified': '0',
        'lastChange': 'null',
        'userId': userId.toString(),
        'keywords': this.convertRecipeKeywordsArray(keywords).join('|'),
        'ingredients': ingr
      }


   /*   let headers = new HttpHeaders();

      headers.append("Access-Control-Allow-Origin", "*");
      headers.append("Access-Control-Allow-Methods", "POST,OPTIONS");

      let options = {
        headers: headers,

     }*/

     const requestLink = this.constant.backendBaseURL + 'api/backend/recipe/recipeset.php';

    let message: string;

    console.log('request finished');

    await (
      this.http
        .post<string>(requestLink, values)
        //.pipe(catchError(this.handleError))
        .toPromise()
    )  .then((data: any) => {
      message = data['message'];
      if(message === 'Recipe created'){
        message = 'Rezept wurde erfolgreich erstellt!';
      }else{
        message = 'Rezept konnte nicht erstellt werden!'
      }
      })
    .catch((error) => {
      this.handleErrorRecipeDetails(error);
    });

    return message;
  }

  /////////////////////////////////Http-Request to change recipe///////////////////////////
  async getServerChangeRecipe( 
    id: number,
    title: string,
    picture: string,
    servings: number,
    description: string,
    instruction: string,
    duration: number,
    difficulty: string,
    userId: number,
    keywords: string[],
    ingredients: Ingredient[]): Promise<Recipe> {
    console.log('server request with keywords');

    let ingr = new Array();
    ingredients.forEach((value, index) => {
      ingr.push({
        'id': value.getId(),
        'amount': value.getAmount(),
        'unit': value.getUnit()
      })
    });

    let values = {
      'id': id,
      'title': title,
      'picture': picture,
      'servings': servings.toString(),
      'description': description,
      'instruction': instruction,
      'creationDate': this.date(),
      'duration': duration.toString(),
      'difficulty': difficulty,
      'certified': '0',
      'lastChange': this.date(),
      'userId': userId.toString(),
      'keywords': this.convertRecipeKeywordsArray(keywords).join('|'),
      'ingredients': ingr
    }

    //console.log(params);

    const requestLink = this.constant.backendBaseURL + 'api/backend/recipe/recipechange.php';

    console.log('request finished');

    return (this.http
    .post<Recipe>(requestLink, values)
    //.pipe(catchError(this.handleError))
    .toPromise())
  }


  /////////////////////////////////convert keywords to their id///////////////////////////
  convertRecipeKeywordsArray(keywords: string[]): string[] {
    let tempRecipe = keywords;
    let keywordsId = [];
    let serverKeywords = this.searchRequestService.getKeywords();

    serverKeywords.forEach((elem1) => {
      elem1;
      tempRecipe.forEach((elem2) => {
        elem2;
        if (elem1.name === elem2) {
          keywordsId.push(elem1.id.toString());
        }
      });
    });
    keywordsId.filter((value) => {
      value === value.id;
    });
    console.log(keywordsId);
    return keywordsId;
  }

  /////////////////////////////////convert ingredient to their id///////////////////////////
  convertRecipeIngredient(keywords: string): number {
    let tempRecipe = keywords;
    let ingredientsId = 0;
    let serverKeywords = this.searchRequestService.getIngredients();

    serverKeywords.forEach((elem1) => {
      elem1;

      if (elem1.description === tempRecipe) {
        ingredientsId = elem1.id;
      }
    });

    return ingredientsId;
  }


  /////////////////////////////////method for current date///////////////////////////
  date() {
    let creation: string;
    creation = this.datePipe.transform(new Date(), 'yyyy-MM-dd  HH:mm:ss');
    console.log(creation);
    return creation;
  }

  /////////////////////////////////////////get from Server user recipes///////////////////////////////////////////
  async getServerUserRecipe(user: User): Promise<Recipe[]> {
    await this.fetchServerUserRecipe(user)
      .then((data: Recipe) => {
        //console.log(data['recipes']);
        data['recipes'].forEach((value: Recipe) => {
          this.userRecipes.push(new Recipe(value));
        });
      })
      .catch((error) => {
        this.handleErrorUserRecipe(error);
      });
    //console.log(this.userRecipes);
    return this.userRecipes;
  }

  /////////////////////////////////Http-Request to get all user recipes///////////////////////////
  async fetchServerUserRecipe(user: User): Promise<Recipe> {
    let params = new HttpParams().set('userId', user.getId().toString());

    console.log(params);

    const requestLink = this.constant.backendBaseURL + 'api/backend/recipe/myrecipes.php';

    return (
      this.http
        .get<Recipe>(requestLink, { params: params })
        //.pipe(catchError(this.handleError))
        .toPromise()
    );
  }

  /////////////////////////////////////////get from Server recipe details///////////////////////////////////////////
  async getServerRecipeDetails(id: number): Promise<Recipe> {
    let nutrients: Nutrient[] = [];
    await this.fetchServerRecipeDetails(id)
      .then((data: Recipe) => {
        data['recipe'].forEach((value) =>{
          this.userRecipe = new Recipe(value);
        })
      })
      .catch((error) => {
        this.handleErrorRecipeDetails(error);
      });

    console.log(this.userRecipe);
    return this.userRecipe;
  }

  /////////////////////////////////Http-Request to get recipe details///////////////////////////
  async fetchServerRecipeDetails(id: number): Promise<Recipe> {
    let params = new HttpParams()
    .set('recipeId', id.toString());

    console.log(params);

    const requestLink = this.constant.backendBaseURL + 'api/backend/recipe/getrecipe.php';

    return (
      this.http
        .get<Recipe>(requestLink, { params: params })
        //.pipe(catchError(this.handleError))
        .toPromise()
    );
  }

   /////////////////////////////////////////get from Server recipe details///////////////////////////////////////////
   async getServerRecipeRating(recipe: Recipe, rating: Ratings): Promise<Recipe> {
    await this.fetchServerRecipeRating(recipe, rating)
      .then((data: Ratings[]) => {

        data['ratings'].forEach((value: Ratings) =>{
          this.recipeRatings.push(new Ratings(value));
        })
        this.userRecipe.setRatings(this.recipeRatings);
        console.log(data['ratings']);
      })
      .catch((error) => {
        this.handleErrorRecipeRating(error);
      });
    console.log(this.userRecipe);
    return this.userRecipe;
  }

  /////////////////////////////////Http-Request to get recipe details///////////////////////////
  async fetchServerRecipeRating(recipe: Recipe, rating: Ratings): Promise<Ratings[]> {
    let params = new HttpParams()
    .set('recipeId', recipe.getId().toString())
    .set('userId', rating.getUserId().toString())
    .set('comment', rating.getComment())
    .set('rating', rating.getRating().toString());

    console.log(params);

    const requestLink = this.constant.backendBaseURL + 'api/backend/recipe/setrating.php';

    return (
      this.http
        .get<Ratings[]>(requestLink, { params: params })
        //.pipe(catchError(this.handleError))
        .toPromise()
    );
  }


  ///////////////////////////////////////method to handle error for create recipe//////////////////////////////////////////////////////////////////
  handleErrorCreateRecipe(error: Response) {
    if (error instanceof ErrorEvent) {
      // Client-side errors
      this.errorValue = `Unerwarteter Fehler. Bitte versuchen Sie später noch Mal.`;
    } else {
      // Server-side errors
      if (error.status === 401) {
        this.errorValue = `Die Verbindung zum Server kann nicht aufgebaut werden`;
      }
      if (error.status === 403) {
        this.errorValue = `Es tut uns leid, das Rezept kann nicht erstellt werden`;
      }
      if (error.status === 404) {
        this.errorValue = `Es tut uns leid, leider gibt es das Rezept bereits.`;
      }
      if (error.status === 500) {
        this.errorValue = `Die Verbindung zum Server ist fehlgeschlagen`;
      }
    }
    return this.errorValue;
  }

  ///////////////////////////////////////method to handle error for change recipe//////////////////////////////////////////////////////////////////
  handleErrorChangeRecipe(error: Response) {
    if (error instanceof ErrorEvent) {
      // Client-side errors
      this.errorValue = `Unerwarteter Fehler. Bitte versuchen Sie später noch Mal.`;
    } else {
      // Server-side errors
      if (error.status === 401) {
        this.errorValue = `Die Verbindung zum Server kann nicht aufgebaut werden`;
      }
      if (error.status === 403) {
        this.errorValue = `Das Rezept exisitert bereits.`;
      }
      if (error.status === 404) {
        this.errorValue = `Es tut uns leid, leider haben wir das Rezept nicht gefunden. `;
      }
      if (error.status === 500) {
        this.errorValue = `Die Verbindung zum Server ist fehlgeschlagen`;
      }
    }
    return this.errorValue;
  }

  ///////////////////////////////////////method to handle error for create recipe//////////////////////////////////////////////////////////////////
  handleErrorUserRecipe(error: Response) {
    if (error instanceof ErrorEvent) {
      // Client-side errors
      this.errorValue = `Unerwarteter Fehler. Bitte versuchen Sie später noch Mal.`;
    } else {
      // Server-side errors
      if (error.status === 401) {
        this.errorValue = `Die Verbindung zum Server kann nicht aufgebaut werden.`;
      }
      if (error.status === 403) {
        this.errorValue = `Die Recepte existieren bereits.`;
      }
      if (error.status === 404) {
        this.errorValue = `Es tut uns leid, leider haben wir keine eigenen Rezepte gefunden.`;
      }
      if (error.status === 500) {
        this.errorValue = `Die Verbindung zum Server ist fehlgeschlagen.`;
      }
    }
    return this.errorValue;
  }

  ///////////////////////////////////////method to handle error for recipe details//////////////////////////////////////////////////////////////////
  handleErrorRecipeDetails(error: Response) {
    if (error instanceof ErrorEvent) {
      // Client-side errors
      this.errorValue = `Unerwarteter Fehler. Bitte versuchen Sie später noch Mal.`;
    } else {
      // Server-side errors
      if (error.status === 401) {
        this.errorValue = `Die Verbindung zum Server kann nicht aufgebaut werden.`;
      }
      if (error.status === 403) {
        this.errorValue = `Leider kein Zugriff.`;
      }
      if (error.status === 404) {
        this.errorValue = `Es tut uns leid, leider wurde das Rezept nicht gefunden.`;
      }
      if (error.status === 500) {
        this.errorValue = `Die Verbindung zum Server ist fehlgeschlagen.`;
      }
    }
    return this.errorValue;
  }

   ///////////////////////////////////////method to handle error for set rating in a recipe//////////////////////////////////////////////////////////////////
   handleErrorRecipeRating(error: Response) {
    if (error instanceof ErrorEvent) {
      // Client-side errors
      this.errorValue = `Unerwarteter Fehler. Bitte versuchen Sie später noch Mal.`;
    } else {
      // Server-side errors
      if (error.status === 401) {
        this.errorValue = `Die Verbindung zum Server kann nicht aufgebaut werden.`;
      }
      if (error.status === 403) {
        this.errorValue = `Tut uns leid, Sie können das Rezept nicht bewerten.`;
      }
      if (error.status === 404) {
        this.errorValue = `Es tut uns leid, leider wurde das Rezept nicht gefunden.`;
      }
      if (error.status === 500) {
        this.errorValue = `Die Verbindung zum Server ist fehlgeschlagen.`;
      }
    }
    return this.errorValue;
  }
}
