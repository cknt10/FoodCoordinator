import { Component, OnInit } from '@angular/core';
import { HttpClient} from '@angular/common/http';

@Component({
  selector: 'app-create-recipe',
  templateUrl: './create-recipe.component.html',
  styleUrls: ['./create-recipe.component.scss']
})
export class CreateRecipeComponent implements OnInit {

  title: string;
  shortDescription: string;
  keyword: string;
  keywords: string[] = [];
  ingredient: string;
  ingredients: string[] = [];
  description: string;
  picture: File;
  servings: number;
  duration: number;
  amount: number;
  unit: string[] = [];
  difficulty: string;


  constructor() { }

  ngOnInit(): void {
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

}
