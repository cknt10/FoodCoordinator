import { Injectable } from '@angular/core';
import { DatePipe } from '@angular/common';

import { HttpClient, HttpParams } from '@angular/common/http';

import { Recipe } from './recipe';
import { SearchReqService } from './search-req.service';
import { Ingredient } from './ingredient';
import { User } from './User';
import { AuthenticationService } from './authentication.service';

@Injectable({
  providedIn: 'root',
})
export class RecipeAdministrationReqService {
  private errorValue: string;
  private userRecipes: Recipe[] = [];
  private userRecipe: Recipe;

  constructor(
    private http: HttpClient,
    private searchRequestService: SearchReqService,
    private datePipe: DatePipe,
    private authenticationService: AuthenticationService
  ) {}

  /////////////////////////////////method to display error message to user///////////////////////////
  getErrorMessage(): string {
    return this.errorValue;
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
    let params = new HttpParams()
      .set('title', title)
      //.set('picture', picture.toString())
      .set('servings', servings.toString())
      .set('description', description)
      .set('instruction', instruction)
      .set('createionDate', this.Date())
      .set('duration', duration.toString())
      .set('difficulty', difficulty)
      .set('certified', '0')
      .set('lastChange', null)
      .set('userId', userId.toString())
      .set('keywords', this.convertRecipeKeywordsArray(keywords).join('|'));

    let modifiedIngredients: Object[] = [];
    ingredients.forEach((value, index) => {
      modifiedIngredients[index] = new Object();
      modifiedIngredients[index] = {
        id: value.getId().toString(),
        amount: value.getAmount().toString(),
        unit: value.getUnit(),
      };
    });

    console.log(modifiedIngredients);

    let jsonFormat: any = {};
    jsonFormat.myArray = JSON.stringify(modifiedIngredients);
    console.log(ingredients);
    console.log(jsonFormat.myArray);

    params = params.append('ingredients', jsonFormat.myArray);

    console.log(params);

    const requestLink = 'http://xcsd.ddns.net/api/backend/recipe/recipeset.php';

    console.log('request finished');

    return (
      this.http
        .get<Recipe>(requestLink, { params: params })
        //.pipe(catchError(this.handleError))
        .toPromise()
    );
  }

  /////////////////////////////////Http-Request to change recipe///////////////////////////
  getServerChangeRecipe(recipe: Recipe): Promise<Recipe> {
    console.log('server request with keywords');

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
      .set('picture', recipe.getPicture().toString())
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

    return (
      this.http
        .get<Recipe>(requestLink, { params: params })
        //.pipe(catchError(this.handleError))
        .toPromise()
    );
  }

  ///////////////////////////////////////////////save created recipe from response //////////////////////////////////
  async getNewServerRecipe(
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
    await this.getCreateRecipe(
      title,
      //picture,
      servings,
      description,
      instruction,
      duration,
      difficulty,
      userId,
      keywords,
      ingredients
    )
      .then((data: Recipe) => {
        this.userRecipe = data['recipe'];
      })
      .catch((error) => {
        this.handleErrorCreateRecipe(error);
      });
    console.log(this.userRecipe);
    return this.userRecipe;
  }

  /////////////////////////////////////////////////save changed recipe from server response ///////////////////////////////////
  async getChangeServerRecipe(recipe: Recipe): Promise<Recipe> {
    await this.getServerChangeRecipe(recipe)
      .then((data: Recipe) => {
        this.userRecipe = new Recipe(data['recipe']);
      })
      .catch((error) => {
        this.handleErrorChangeRecipe(error);
      });
    console.log(this.userRecipe);
    return this.userRecipe;
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

  /////////////////////////////////convert ingredients to their id///////////////////////////
  convertRecipeIngredientsArray(keywords: Ingredient[]): Ingredient[] {
    let tempRecipe = keywords;
    let ingredientsId = [];
    let serverKeywords = this.searchRequestService.getIngredients();

    serverKeywords.forEach((elem1) => {
      elem1;
      tempRecipe.forEach((elem2) => {
        elem2;
        if (elem1.description === elem2.getDescription()) {
          ingredientsId.push(elem1.id.toString());
        }
      });
    });

    ingredientsId.filter((value) => {
      value === value.id;
    });

    return ingredientsId;
  }

  /////////////////////////////////convert keyword to their id///////////////////////////
  convertRecipeKeyword(keywords: string): string {
    let keywordsId: string = '';
    let serverKeywords = this.searchRequestService.getKeywords();

    serverKeywords.forEach((elem1) => {
      elem1;
      if (elem1.name === keywords) {
        keywordsId = elem1.id.toString();
      }
    });

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
  Date() {
    let creation: string;
    creation = this.datePipe.transform(new Date(), 'yyyy-MM-dd  HH:mm:ss');
    console.log(creation);
    return creation;
  }

  /////////////////////////////////////////get from Server user recipes///////////////////////////////////////////
  async getServerUserRecipe(user: User): Promise<Recipe[]> {
    await this.fetchServerUserRecipe(user)
      .then((data: Recipe) => {
        data['recipes'].forEach((value: Recipe) => {
          this.userRecipes.push(new Recipe(value));
        });
      })
      .catch((error) => {
        this.handleErrorUserRecipe(error);
      });
    console.log(this.userRecipes);
    return this.userRecipes;
  }

  /////////////////////////////////Http-Request to get all Cities///////////////////////////
  async fetchServerUserRecipe(user: User): Promise<Recipe> {
    let params = new HttpParams().set('userId', user.getId().toString());

    console.log(params);

    const requestLink = 'http://xcsd.ddns.net/api/backend/recipe/myrecipes.php';

    return (
      this.http
        .get<Recipe>(requestLink, { params: params })
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
        this.errorValue = `Es tut uns leid, ${this.authenticationService
          .getUser()
          .getUsername()}, das Rezept kann nicht erstellt werden`;
      }
      if (error.status === 404) {
        this.errorValue = `Es tut uns leid, ${this.authenticationService
          .getUser()
          .getUsername()}, leider gibt es das Rezept bereits.`;
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
        this.errorValue = `Es tut uns leid, ${this.authenticationService
          .getUser()
          .getUsername()}, leider haben wir das Rezept nicht gefunden.} `;
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
        this.errorValue = `Die Verbindung zum Server kann nicht aufgebaut werden`;
      }
      if (error.status === 403) {
        this.errorValue = `Die Recepte existieren bereits.`;
      }
      if (error.status === 404) {
        this.errorValue = `Es tut uns leid, ${this.authenticationService
          .getUser()
          .getUsername()}, leider haben wir keine eigenen Rezepte gefunden.}`;
      }
      if (error.status === 500) {
        this.errorValue = `Die Verbindung zum Server ist fehlgeschlagen`;
      }
    }
    return this.errorValue;
  }
}
