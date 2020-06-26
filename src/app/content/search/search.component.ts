import { Component, OnInit, Input } from '@angular/core';
import { FormBuilder, Validator, FormControl } from '@angular/forms';
import { SearchReqService } from '../../search-req.service';
import { Recipe } from 'src/app/recipe';

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
  recipes: Recipe[] = [];
  drop = new FormControl();
  error: string;

  constructor(
    private searchReqService: SearchReqService
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
    } else {
      window.alert('Wähle bitte einen gültigen Suchbegriff');
    }
    this.ingredient = '';
    while (this.options.length !== 0) {
      this.options.shift();
    }
  }

  // remove added ingredient in array ingredients at index where the user clicks
  removeIngredient(i: number) {
    this.ingredients.splice(i, 1);
  }

  ////////////////////////Http-Request to get user searched recipes///////////////////////////////////////////
  async search() {
    //search recipes if there is one or more values in ingredients and the search area is empty
    if (this.ingredients.length > 0 && this.ingredient.length == 0) {
      //getUserResults returns all recipes which include the stored ingredients
      console.log(await this.searchReqService.getUserResults(this.ingredients));
    }
    //add valid value in search area to ingredients and return recipes
    else if (
      this.ingredient.length > 0 &&
      this.options.includes(this.ingredient)
    ) {
      this.addIngredient();
      console.log(await this.searchReqService.getUserResults(this.ingredients));
    }
    //if there is nowhere a value or just an invalid value don't search
    else if (
      (this.ingredient.length == 0 && this.ingredients.length == 0) ||
      (this.ingredient.length > 0 && !this.options.includes(this.ingredient))
    ) {
      this.addIngredient();
    }
    this.searchReqService.saveUserInput(this.ingredients);
  }

  ////////////////////////suggestions for search///////////////////////////////////////////
  suggestions() {
    //compare users input with every keyword to find a match
    for (let i = 0; i < this.allKeywords.length; i++) {
      //if user input matches values in keyword array push value into options to display whats selectable
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
