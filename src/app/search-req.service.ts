import { Injectable } from '@angular/core';
import {
  HttpClient,
  HttpParams,
  HttpErrorResponse,
} from '@angular/common/http';
import { Recipe } from './recipe';
import { SearchParameter } from './searchParameter';

import { throwError } from 'rxjs';
import { catchError } from 'rxjs/operators';

@Injectable({
  providedIn: 'root',
})
export class SearchReqService {
  private searchedKeywords: SearchParameter[];
  private serverIngredients: SearchParameter[];
  private serverKeywords: SearchParameter[];
  private filteredKeywords: string[] = [];

  private errorValue: string;

  constructor(private http: HttpClient) {}

  /////////////////////////////////method to get keywords without duplicate and id///////////////////////////
  getFilteredKeywords(): string[] {
    return this.filteredKeywords;
  }

  /////////////////////////////////method to display error message to user///////////////////////////
  getErrorMessageUser(): string {
    return this.errorValue;
  }

  /////////////////////////////////method to display keywords with id///////////////////////////
  getKeywords(): SearchParameter[]{
    return this.serverKeywords;
  }

  /////////////////////////////////method to display ingredients with id///////////////////////////
  getIngredients(): SearchParameter[]{
    return this.serverIngredients;
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
    });
    this.parseJson(this.serverIngredients);
    return this.serverIngredients;
  }

  /////////////////////////////////method to get keywords as proposition///////////////////////////
  async getServerKeywords(): Promise<SearchParameter[]> {
    await this.fetchServerSearchPropositionForKeywords().then((data) => {
      this.serverKeywords = data['keywords'];
    });
    this.parseJson(this.getKeywords());
    return this.serverKeywords;
  }

  /////////////////////////////////Http-Request method to get ingredients as proposition///////////////////////////
  async fetchServerSearchPropositionForIngredients() {
    const requestLink =
      'http://xcsd.ddns.net/api/backend/search/getingredients.php';

    return this.http
      .get<string>(requestLink)
      .pipe(catchError(this.handleError))
      .toPromise();
  }

  /////////////////////////////////Http-Request method to get keywords as proposition///////////////////////////
  async fetchServerSearchPropositionForKeywords(): Promise<string> {
    const requestLink =
      'http://xcsd.ddns.net/api/backend/search/getkeywords.php';

    return this.http
      .get<string>(requestLink)
      .pipe(catchError(this.handleError))
      .toPromise();
  }

  parseJson(array: SearchParameter[]){
    //JSON.stringify(array, null, '').replace("\\r", " ");
    array.filter(function() {
      return function(value) {
        return (!value) ? '' : value.replace(/(\\r\\n|\\n|\\r)/gm, "");
      };
    });
  }

  /////////////////////////////////Http-Request method to send keywords and get results of the search//////////////////////////
  async getUserResults(userSearchInputs: string[]): Promise<Recipe> {
    console.log('server request with keywords');

    console.log(userSearchInputs);

    let params = new HttpParams().set('keys', userSearchInputs.join('|'));

    console.log(params);

    const requestLink =
      'http://xcsd.ddns.net/api/backend/search/search.php';

    console.log('request finished');

    return this.http
      .get<Recipe>(requestLink, { params: params })
      .pipe(catchError(this.handleError))
      .toPromise();
  }

  /////////////////////////////////analyze kind of error//////////////////////////
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
        this.errorValue = `Leider haben wir noch keine Rezepte zu diesem Suchbegriff.`;
      }
      if (error.status == 500) {
        this.errorValue = `Die Verbindung zum Server wurde fehlgeschlagen.`;
      }
      errorMessage = `Error Code: ${error.status}\nMessage: ${error.message}`;
    }
    return throwError(errorMessage);
  }
}
