import { Component, OnInit, ErrorHandler } from '@angular/core';
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
  ingredient: string;
  ingredients: string[] = [];
  options: string[] = [];
  recipe: Recipe;
  drop = new FormControl();
  error: string;

  constructor(
    private searchReqService: SearchReqService,
    private recipeAdministrationReqService:RecipeAdministrationReqService
  ) { }

  ////////////////////////get Keywords from Server as proposition///////////////////////////////////////////
  async ngOnInit() {
  await this.searchReqService.fetchSearchKeywords().then(data =>
    console.log(this.searchReqService.filterKeywords())); // Hier alle Keywords, durch getFilteredKeywords() abrufen

  }

  ////////////////////////add ingredient to array///////////////////////////////////////////
  addIngredient(){
    let all = this.searchReqService.getFilteredKeywords();
    if (this.ingredient){
      for (let i = 0; i <= all.length; i++) {
        if (all[i] === this.ingredient){
        }
      }
      this.ingredients.push(this.ingredient);
      this.ingredient = "";
      while (this.options.length !== 0) {
      this.options.shift();
      }
    }
  }

// remove added ingredient in array ingredients at index where the user clicks
  removeIngredient(i: number) {
    this.ingredients.splice(i,1);
  }

  ////////////////////////Http-Request to get user searched recipes///////////////////////////////////////////
  async search(){
    let all = this.searchReqService.getFilteredKeywords();
    if (this.ingredient){
      for (let i = 0; i <= all.length; i++) {
        if (all[i] === this.ingredient){
        }
      }
      this.ingredients.push(this.ingredient);
      this.ingredient = "";
      while (this.options.length !== 0) {
      this.options.shift();
      }
    }

  console.log(await this.searchReqService.getUserResults(this.ingredients)); // Hier alle Rezepte,
  }

  ////////////////////////suggestions for search///////////////////////////////////////////
  suggestions(){
    let all = this.searchReqService.getFilteredKeywords();
    //does the users input match with our keywords
    for (let i = 0; i <= all.length; i++) {
      //if user input matches some word in the complete keyword array
      //push the value into options to display him what he can choose
      if (all[i].match(this.ingredient)) {
        this.options.push(all[i]);
      }
      else{
        //if keywords do not match input, remove value i from options
        this.options.splice(i);
      }
    }
  };

  throwError(){
    console.log(this.searchReqService.getErrorMessageUser());
    //window.alert(this.error);
  }

}
