import { Injectable } from '@angular/core';
import {
  HttpClient,
  HttpParams,
  HttpErrorResponse,
} from '@angular/common/http';
import { Recipe } from './recipe';
import { LoginReqService } from './login-req.service';
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

  private recipe: Recipe;

  constructor(
    private http: HttpClient,
    private loginReqService: LoginReqService
  ) {}

  /////////////////////////////////methode to filter duplicate Keywords///////////////////////////
  filterKeywords(): string[] {
    let filtered: string[] = [];

    for (let value of this.serverIngredients) {
      filtered.push(value.description);
    }

    for (let value of this.serverKeywords) {
      filtered.push(value.name);
    }
    console.log(filtered);
    filtered = filtered.filter(
      (value, index) => filtered.indexOf(value) === index
    );
    console.log(filtered);
    return filtered;
  }

  /////////////////////////////////methode to fetch Keywords as proposition///////////////////////////
  async fetchSearchKeywords(): Promise<SearchParameter[]> {
    await Promise.all([
      this.getServerIngredients(),
      this.getServerKeywords(),
    ]).then((data) => {
      this.searchedKeywords = this.serverIngredients.concat(
        this.serverKeywords
      );
    });
    console.log(this.searchedKeywords);
    return this.searchedKeywords;
  }

  /////////////////////////////////methode to get ingredients as proposition///////////////////////////
  async getServerIngredients(): Promise<SearchParameter[]> {
    await this.fetchServerSearchPropositionForIngredients().then((data) => {
      this.serverIngredients = data['ingredients'];
    });
    return this.serverIngredients;
  }

  /////////////////////////////////methode to get keywords as proposition///////////////////////////
  async getServerKeywords(): Promise<SearchParameter[]> {
    await this.fetchServerSearchPropositionForKeywords().then((data) => {
      this.serverKeywords = data['keywords'];
    });
    return this.serverKeywords;
  }

  /////////////////////////////////Http-Request methode to get ingredients as proposition///////////////////////////
  async fetchServerSearchPropositionForIngredients() {
    const requestLink =
      'http://xcsd.ddns.net/api/backend/search/getingredients.php';

    return this.http
      .get<string>(requestLink)
      .pipe(catchError(this.handleError))
      .toPromise();
  }

  /////////////////////////////////Http-Request methode to get keywords as proposition///////////////////////////
  async fetchServerSearchPropositionForKeywords(): Promise<string> {
    const requestLink =
      'http://xcsd.ddns.net/api/backend/search/getkeywords.php';

    return this.http
      .get<string>(requestLink)
      .pipe(catchError(this.handleError))
      .toPromise();
  }

  /////////////////////////////////Http-Request methode to send Keywords and get results of the search//////////////////////////
  async getUserResults(userSearchInputs: string[]): Promise<Recipe> {
    console.log('Server request with keywords');

    console.log(userSearchInputs);

    let params = new HttpParams();
    userSearchInputs.forEach((userSearchInput) => {
      params = params.append('', userSearchInput);
    });

    console.log(params);

    const requestLink = 'http://xcsd.ddns.net/api/backend/search/search.php';

    console.log('request finished');

    return this.http
      .get<Recipe>(requestLink, { params: params })
      .pipe(catchError(this.handleError))
      .toPromise();
  }

  /*at the first needed because another solution isn't pushed on master*/
  handleError(error: HttpErrorResponse) {
    let errorMessage = 'Unknown error!';
    if (error.error instanceof ErrorEvent) {
      // Client-side errors
      errorMessage = `Error: ${error.error.message}`;
    } else {
      // Server-side errors
      errorMessage = `Error Code: ${error.status}\nMessage: ${error.message}`;
    }
    //window.alert(errorMessage);
    return throwError(errorMessage);
  }

  ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
}
