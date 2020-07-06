import { Injectable } from '@angular/core';

import { Recipe } from './recipe';
import { SearchReqService } from './search-req.service';
import { Ingredient } from './ingredient';
import { User } from './User';
import { Ratings } from './ratings';


@Injectable({
  providedIn: 'root'
})
export class RecipeAdministrationService {


  private ingredients: string[] = [];
  private allKeywords: string[] = [];
  private options: string[] = [];
  private recipes: Recipe[] = [];
  private ratings: Ratings[] = [];

  constructor() { }


setRecipes(recipeValues: Recipe[]): Recipe[]{
  this.recipes=recipeValues;
  return this.recipes
}

getRecipes(): Recipe[]{
  return this.recipes
}

}
