import { Component, OnInit } from '@angular/core';
import { FormBuilder, Validator } from '@angular/forms';
import { SearchReqService } from '../../search-req.service';
import { Recipe } from 'src/app/recipe';


import { RecipeAdministrationReqService } from 'src/app/recipe-administration-req.service';

@Component({
  selector: 'app-search',
  templateUrl: './search.component.html',
  styleUrls: ['./search.component.scss']
})
export class SearchComponent implements OnInit {

  ingredient: string;
  ingredients: string[] = [];
  recipe: Recipe;
  keywords: string;

  constructor(
    private searchReqService: SearchReqService,
    private recipeAdministrationReqService:RecipeAdministrationReqService
  ) { }

  ////////////////////////get Keywords from Server as proposition///////////////////////////////////////////
  async ngOnInit() {
  await this.searchReqService.fetchSearchKeywords().then(data =>
    console.log(this.searchReqService.filterKeywords()));

  }

  ////////////////////////add ingredient to array///////////////////////////////////////////
  addIngredient(){
   if (this.ingredient){
      this.ingredients.push(this.ingredient);
      this.ingredient = "";
    }
    else {
      window.alert("Bitte füge eine Zutat hinzu!");
    }
  }

  ////////////////////////Http-Request to get user searched recipes///////////////////////////////////////////
  async search(){
    if(this.ingredient != ""){
      this.ingredients.push(this.ingredient);
      this.ingredient = ""
    }
    ///console.log(await this.searchReqService.getUserResults(this.ingredients));
    this.recipeAdministrationReqService.converRecipeKeywordsArray(this.ingredients);
  }

  ////////////////////////suggestions for search///////////////////////////////////////////
  suggestions(){
    console.log(this.searchReqService.getFilteredKeywords());  
  }

}
