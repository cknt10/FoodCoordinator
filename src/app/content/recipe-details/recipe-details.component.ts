import { Component, OnInit, Input } from '@angular/core';
import { SearchReqService } from '../../search-req.service';
import { Recipe } from 'src/app/recipe';
import { ActivatedRoute } from '@angular/router';
import { RecipeAdministrationReqService } from 'src/app/recipe-administration-req.service';
import { Location } from '@angular/common';
import { Ingredient } from 'src/app/ingredient';
import { Ratings } from 'src/app/ratings';

@Component({
  selector: 'app-recipe-details',
  templateUrl: './recipe-details.component.html',
  styleUrls: ['./recipe-details.component.scss']
})
export class RecipeDetailsComponent implements OnInit {
  recipe: Recipe;
  ingredients: Ingredient[] = [];
  ratings: Ratings[] = [];

  constructor(
    private route: ActivatedRoute,
    private searchReqService: SearchReqService,
    private recipeAdministrationReqService: RecipeAdministrationReqService,
    private location: Location
  ) { }

  async ngOnInit() {
    await this.getRecipe();
    this.ingredients=this.recipe.getIngredients();
    console.log(this.ingredients);
    /*this.setIngredients();
    this.setRatings();*/
  }

  async getRecipe(): Promise<Recipe> {
    const id = +this.route.snapshot.paramMap.get('id');
    await this.recipeAdministrationReqService.getServerRecipeDetails(id).then ((data: Recipe) => {
      this.recipe = data;
    })
      //.subscribe(recipe => this.recipe = recipe);
      console.log(this.recipe);
      return this.recipe;

  }

  throwError() {
    console.log(this.recipeAdministrationReqService.getErrorMessage());
    //window.alert(this.error);
  }

  setIngredients(){
    //this.ingredients = this.recipe.getIngredients();
    console.log(this.ingredients);
  }

  setRatings(){
    this.ratings = this.recipe.getRatings();
    console.log(this.ratings);
  }

  goBack(): void {
    this.location.back();
  }
}
