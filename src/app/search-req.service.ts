import { Injectable } from '@angular/core';
import {
  HttpClient,
  HttpParams,
} from '@angular/common/http';
import { Recipe } from './recipe';
import { SearchParameter } from './searchParameter';

import { Ingredient } from './ingredient';

@Injectable({
  providedIn: 'root',
})
export class SearchReqService {
  private searchedKeywords: SearchParameter[];
  private serverIngredients: SearchParameter[];
  private serverKeywords: SearchParameter[];
  private filteredKeywords: string[] = [];
  private userRecipes: Recipe[] = [];

  private errorValue: string;

  constructor(private http: HttpClient) {}

  /////////////////////////////////method to get keywords without duplicate and id///////////////////////////
  getFilteredKeywords(): string[] {
    return this.filteredKeywords;
  }

  /////////////////////////////////method to display error message to user///////////////////////////
  getErrorMessage(): string {
    return this.errorValue;
  }

  /////////////////////////////////method to display keywords with id///////////////////////////
  getKeywords(): SearchParameter[] {
    return this.serverKeywords;
  }

  /////////////////////////////////method to display ingredients with id///////////////////////////
  getIngredients(): SearchParameter[] {
    return this.serverIngredients;
  }

  /////////////////////////////////method to get results of recipes from searcher///////////////////////////
  getUserResults() {
    return this.userRecipes;
  }

    /////////////////////////////////Http-Request get results of the search//////////////////////////
    async getUserServerResult(userSearchInputs: string[]) {
      await this.fetchUserServerResults(userSearchInputs).then((data) => {
        data['recipe'].forEach((value: Recipe) => {
          this.userRecipes.push(new Recipe(value));
        });
      }).catch (error => {
        this.handleErrorSearchResults(error);
        });
      return this.userRecipes;
    }

  /////////////////////////////////method to filter duplicate keywords///////////////////////////
  filterKeywords(): string[] {
    let filtered: string[] = [];

    for (let value of this.serverIngredients) {
      filtered.push(value.description);
    }

    for (let value of this.serverKeywords) {
      filtered.push(value.name);
    }
    filtered = filtered.filter(
      (value, index) => filtered.indexOf(value) === index
    );
    this.filteredKeywords = filtered;
    return filtered;
  }

  /////////////////////////////////method to fetch keywords as proposition///////////////////////////
  async fetchSearchKeywords(): Promise<SearchParameter[]> {
    await Promise.all([
      this.getServerIngredients(),
      this.getServerKeywords(),
    ]).then((data) => {
      this.searchedKeywords = this.serverIngredients.concat(
        this.serverKeywords
      );
    });

    this.filterKeywords();
    console.log(this.searchedKeywords);
    return this.searchedKeywords;
  }

  /////////////////////////////////method to get ingredients as proposition///////////////////////////
  async getServerIngredients(): Promise<SearchParameter[]> {
    await this.fetchServerSearchPropositionForIngredients().then((data) => {
      this.serverIngredients = data['ingredients'];
    }).catch (error => {
      this.handleErrorIngredients(error);
      });
    return this.serverIngredients;
  }

  /////////////////////////////////method to get keywords as proposition///////////////////////////
  async getServerKeywords(): Promise<SearchParameter[]> {
    await this.fetchServerSearchPropositionForKeywords().then((data) => {
      this.serverKeywords = data['keywords'];
    }).catch (error => {
      this.handleErrorKeywords(error);
      });
    return this.serverKeywords;
  }

  /////////////////////////////////Http-Request method to get ingredients as proposition///////////////////////////
  async fetchServerSearchPropositionForIngredients(): Promise<Ingredient> {
    const requestLink =
      'http://xcsd.ddns.net/api/backend/search/getingredients.php';

    return (
      this.http
        .get<Ingredient>(requestLink)
        //.pipe(catchError(this.handleError))
        .toPromise()
    );
  }

  /////////////////////////////////Http-Request method to get keywords as proposition///////////////////////////
  async fetchServerSearchPropositionForKeywords(): Promise<string> {
    const requestLink =
      'http://xcsd.ddns.net/api/backend/search/getkeywords.php';

    return (
      this.http
        .get<string>(requestLink)
        //.pipe(catchError(this.handleError))
        .toPromise()
    );
  }

  /////////////////////////////////Http-Request method to send keywords and get results of the search//////////////////////////
  async fetchUserServerResults(userSearchInputs: string[]): Promise<Recipe> {

    let params = new HttpParams().set('keys', userSearchInputs.join('|'));

    const requestLink = 'http://xcsd.ddns.net/api/backend/search/search.php';

    return (
      this.http
        .get<Recipe>(requestLink, { params: params })
        //.pipe(catchError(this.handleError))
        .toPromise()
    );
  }


  ///////////////////////////////////////method to handle error for search results//////////////////////////////////////////////////////////////////
  handleErrorSearchResults(error: Response) {
    if (error instanceof ErrorEvent) {
      // Client-side errors
      this.errorValue = `Unerwarteter Fehler. Bitte versuchen Sie später noch Mal.`;
    } else {
      // Server-side errors
      if (error.status === 401) {
        this.errorValue = `Die Verbindung zum Server kann nicht aufgebaut werden.`;
      }
      if (error.status === 403) {
        this.errorValue = `Die Suchbegriffe wurden nicht korrekt eingegeben.`;
      }
      if (error.status === 404) {
        this.errorValue = `Leider wurden keine passenden Rezepte gefunden.`;
      }
      if (error.status === 500) {
        this.errorValue = `Die Verbindung zum Server ist fehlgeschlagen`;
      }
    }
    return this.errorValue;
  }

  ///////////////////////////////////////method to handle error for ingredients //////////////////////////////////////////////////////////////////
  handleErrorIngredients(error: Response) {
    if (error instanceof ErrorEvent) {
      // Client-side errors
      this.errorValue = `Unerwarteter Fehler. Bitte versuchen Sie später noch Mal.`;
    } else {
      // Server-side errors
      if (error.status === 401) {
        this.errorValue = `Die Verbindung zum Server kann nicht aufgebaut werden.`;
      }
      if (error.status === 403) {
        this.errorValue = `Die Zutaten wurden nicht korrekt eingegeben.`;
      }
      if (error.status === 404) {
        this.errorValue = `Leider wurden keine Zutaten gefunden.`;
      }
      if (error.status === 500) {
        this.errorValue = `Die Verbindung zum Server ist fehlgeschlagen`;
      }
    }
    return this.errorValue;
  }

  ///////////////////////////////////////method to handle error for cities//////////////////////////////////////////////////////////////////
  handleErrorKeywords(error: Response) {
    if (error instanceof ErrorEvent) {
      // Client-side errors
      this.errorValue = `Unerwarteter Fehler. Bitte versuchen Sie später noch Mal.`;
    } else {
      // Server-side errors
      if (error.status === 401) {
        this.errorValue = `Die Verbindung zum Server kann nicht aufgebaut werden.`;
      }
      if (error.status === 403) {
        this.errorValue = `Die Stichwörter wurden nicht korrekt eingegeben.`;
      }
      if (error.status === 404) {
        this.errorValue = `Leider wurden keine Suchbegriffe gefunden.`;
      }
      if (error.status === 500) {
        this.errorValue = `Die Verbindung zum Server ist fehlgeschlagen`;
      }
    }
    return this.errorValue;
  }
}
