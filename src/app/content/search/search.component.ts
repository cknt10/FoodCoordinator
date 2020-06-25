import { Component, OnInit, ErrorHandler } from '@angular/core';
import { FormBuilder, Validator, FormControl } from '@angular/forms';
import { SearchReqService } from '../../search-req.service';
import { Recipe } from 'src/app/recipe';

import { RecipeAdministrationReqService } from 'src/app/recipe-administration-req.service';

@Component({
  selector: 'app-search',
  templateUrl: './search.component.html',
  styleUrls: ['./search.component.scss'],
})
export class SearchComponent implements OnInit {
  ingredient: string;
  ingredients: string[] = [];
  allKeywords: string[] = [];
  options: string[] = [];
  recipes: Recipe[];
  drop = new FormControl();
  error: string;

  constructor(
    private searchReqService: SearchReqService,
    private recipeAdministrationReqService: RecipeAdministrationReqService
  ) {}

  ////////////////////////get Keywords from Server as proposition///////////////////////////////////////////
  async ngOnInit() {
    await this.searchReqService
      .fetchSearchKeywords()
      .then((data) => console.log(this.searchReqService.filterKeywords())); // Hier alle Keywords, durch getFilteredKeywords() abrufen
    this.allKeywords = this.searchReqService.getFilteredKeywords();
  }
  ////////////////////////add ingredient to array///////////////////////////////////////////
  addIngredient() {
    if (this.options.includes(this.ingredient)) {
      this.ingredients.push(this.ingredient);
      this.ingredient = '';
      while (this.options.length !== 0) {
        this.options.shift();
      }
    } else {
      window.alert('Wähle bitte einen gültigen Suchbegriff');
    }
  }

  // remove added ingredient in array ingredients at index where the user clicks
  removeIngredient(i: number) {
    this.ingredients.splice(i, 1);
  }

  ////////////////////////Http-Request to get user searched recipes///////////////////////////////////////////
  async search() {
    if (this.ingredients.length > 0 && this.ingredient.length == 0) {
      console.log(await this.searchReqService.getUserResults(this.ingredients)); // Hier alle Rezepte
    } else if (
      this.ingredient.length > 0 &&
      this.options.includes(this.ingredient)
    ) {
      this.addIngredient();
      console.log(await this.searchReqService.getUserResults(this.ingredients)); // Hier alle Rezepte
    } else if (
      (this.ingredient.length == 0 && this.ingredients.length == 0) ||
      (this.ingredient.length > 0 && !this.options.includes(this.ingredient))
    ) {
      window.alert(
        'Bitte gib einen gültigen Suchbegriff ein, so können wir nicht arbeiten'
      );
    }
  }

  ////////////////////////suggestions for search///////////////////////////////////////////
  suggestions() {
    //this.allKeywords = this.searchReqService.getFilteredKeywords();
    //does the users input match with our keywords
    for (let i = 0; i < this.allKeywords.length; i++) {
      //if user input matches some word in the complete keyword array
      //push the value into options to display him what he can choose
      if (
        this.allKeywords[i].match(this.ingredient) &&
        !this.ingredients.includes(this.allKeywords[i])
      ) {
        this.options.push(this.allKeywords[i]);
      } else {
        //if keywords do not match input, remove value i from options
        this.options.splice(i);
      }
    }
  }

  throwError() {
    console.log(this.searchReqService.getErrorMessageUser());
    //window.alert(this.error);
  }
}
