import { Component, OnInit } from '@angular/core';
import { FormBuilder, Validator, FormControl} from '@angular/forms';
import { ReactiveFormsModule } from '@angular/forms';
import { SearchReqService } from '../../search-req.service';
import { Recipe } from 'src/app/recipe';

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
  keywords: string;
  myControl = new FormControl('');

  constructor(
    private searchReqService: SearchReqService
  ) { }

  ////////////////////////get Keywords from Server as proposition///////////////////////////////////////////
  ngOnInit() {
  this.searchReqService.fetchSearchKeywords();
  }

  ////////////////////////add ingredient to array///////////////////////////////////////////
  addIngredient(){
   if (this.ingredient){
      this.ingredients.push(this.ingredient);
      this.ingredient ="";
    }
    else {
      window.alert("Bitte füge eine Zutat hinzu!");
    }
  }

  ////////////////////////Http-Request to get user searched recipes///////////////////////////////////////////
  async search(){
    if(this.ingredient != null){
    this.addIngredient();
    }
    console.log(await this.searchReqService.getUserResults(this.ingredients));
  }

  ////////////////////////suggestions for search///////////////////////////////////////////
  suggestions(){
    this.options=this.searchReqService.getFilteredKeywords();
    console.log(this.searchReqService.getFilteredKeywords());
  }

}
