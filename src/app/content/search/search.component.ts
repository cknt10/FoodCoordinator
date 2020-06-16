import { Component, OnInit } from '@angular/core';
import { FormBuilder, Validator } from '@angular/forms';
import { SearchReqService } from '../../search-req.service';
import { Recipe } from 'src/app/recipe';

@Component({
  selector: 'app-search',
  templateUrl: './search.component.html',
  styleUrls: ['./search.component.scss']
})
export class SearchComponent implements OnInit {

  ingredient: string;
  ingredients: string[];
  recipe: Recipe;
  keywords: string;

  constructor(
    private searchReqService: SearchReqService
  ) { }

  ////////////////////////get Keywords from Server as proposition///////////////////////////////////////////
  ngOnInit() {
  this.searchReqService.fetchSearchKeywords();

  }


  addIngredient(){
   if (this.ingredient){
      this.ingredients.push(this.ingredient);
      this.ingredient ="";
    }
    else {
      window.alert("Bitte füge eine Zutat hinzu!");
    }
  }

  async search(){
    console.log(await this.searchReqService.getUserResults(this.ingredients));
  }

  suggestions(){
    this.searchReqService.filterKeywords();
    
   
    
    
    
    
  }

}
