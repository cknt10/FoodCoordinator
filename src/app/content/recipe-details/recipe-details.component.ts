import { Component, OnInit, Input } from '@angular/core';
import { Recipe } from 'src/app/recipe';
import { ActivatedRoute } from '@angular/router';

import { RecipeAdministrationReqService } from 'src/app/recipe-administration-req.service';
import { AuthenticationService } from '../../authentication.service';

import { Ingredient } from 'src/app/ingredient';
import { Ratings } from 'src/app/ratings';
import { Nutrient } from 'src/app/nutrient';

@Component({
  selector: 'app-recipe-details',
  templateUrl: './recipe-details.component.html',
  styleUrls: ['./recipe-details.component.scss'],
})
export class RecipeDetailsComponent implements OnInit {
  recipe: Recipe;
  ingredients: Ingredient[] = [];
  nutrients: Nutrient[] = [];
  ratings: Ratings[] = [];

  constructor(
    private route: ActivatedRoute,
    private recipeAdministrationReqService: RecipeAdministrationReqService,
    private user: AuthenticationService
  ) {}

  async ngOnInit() {
    await this.getRecipe();
    this.getNutrients();
    console.log(this.countAmount());

  }

  async getRecipe(): Promise<Recipe> {
    const id = +this.route.snapshot.paramMap.get('id');

    let isPremium: boolean;
    if (this.user.getUser() != null) {
      isPremium = this.user.getUser().getIsPremium();
    } else {
      isPremium = false;
    }

    await this.recipeAdministrationReqService
      .getServerRecipeDetails(id, isPremium)
      .then((data: Recipe) => {
        this.recipe = data;
        this.ingredients = this.recipe.getIngredients();
        this.ratings = this.recipe.getRatings();
      });
    return this.recipe;
  }

  throwError() {
    console.log(this.recipeAdministrationReqService.getErrorMessage());
    //window.alert(this.error);
  }

  getNutrients(){
    this.ingredients.forEach((value) => {
      if (value.nutrients != null) {
        value.nutrients.forEach((nut) => {
          if (nut.id != null && nut.amount != null && nut.description != null) {
            this.nutrients.push(nut);
          }
        });
      }
    });

    return this.nutrients;
  }

  countAmount() {
   


    let desc: Nutrient[] = this.nutrients;

    //console.log(desc);

    /* sortiere nach Beschreibung */
    desc.sort(this.compare);

    //console.log(desc);
    /* sortiere nach Beschreibung */

    for (var i = 0; i <= desc.length -1; i++) {
      desc[i].amount = 0;

      }

    desc =  desc.filter(
      (value, index) =>desc.findIndex(t => t.id === value.id) === index
    );


    for(let i: number = 0; i<= this.nutrients.length-1; i++){
      console.log(this.nutrients[i].amount);
    }

    this.nutrients.forEach((value, index) =>{
      desc.forEach((amount, i) =>{
        if(value.description === amount.description){
          desc[i].amount = amount.amount + value.amount;
        }
      })
    })

    console.log(desc);

    for (var i = 0; (i = desc.length); i++) {
      for (var j = 0; (j = this.nutrients.length); j++) {
        if (desc[i].description === this.nutrients[i].description) {
          desc[i].amount += this.nutrients[i].amount;
        }
      }
    }
    console.log(desc);
    return desc;
  }

  compare(a, b): number {
    if (a.description < b.description) {
      return -1;
    }
    if (a.description > b.description) {
      return 1;
    }
    return 0;
  }
}
