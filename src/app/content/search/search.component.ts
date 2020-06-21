import { Component, OnInit } from '@angular/core';
import { FormBuilder, Validator, FormControl } from '@angular/forms';
import { SearchReqService } from '../../search-req.service';
import { Recipe } from 'src/app/recipe';


import { RecipeAdministrationReqService } from 'src/app/recipe-administration-req.service';

@Component({
  selector: 'app-search',
  templateUrl: './search.component.html',
  styleUrls: ['./search.component.scss']
})
export class SearchComponent implements OnInit {
  neu: string;
  input: string;
  ingredient: string;
  ingredients: string[] = [];
  options: string[] = [];
  recipe: Recipe;
  drop = new FormControl();

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


  removeIngredient(){
    //TO-DO: remove an ingredient from array
  }

  ////////////////////////Http-Request to get user searched recipes///////////////////////////////////////////
  async search(){
    if(this.ingredient != ""){
      this.ingredients.push(this.ingredient);
      this.ingredient = ""
    }
  await this.searchReqService.getUserResults(this.ingredients);
  }

  ////////////////////////suggestions for search///////////////////////////////////////////
  suggestions(){
    let all = this.searchReqService.getFilteredKeywords(), i, j;
    this.input = this.ingredient;
    //does the users input match with our keywords
    for (i = 0; i < all.length; i++) {
      if (all[i].match(this.input)) {
            this.options.push(all[i]);
          }
  }
  };

}
