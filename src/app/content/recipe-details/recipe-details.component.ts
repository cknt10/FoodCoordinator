import { Component, OnInit, Input } from '@angular/core';
import { Recipe } from 'src/app/recipe';
import { ActivatedRoute } from '@angular/router';
import { RecipeAdministrationReqService } from 'src/app/recipe-administration-req.service';
import { Ingredient } from 'src/app/ingredient';
import { Ratings } from 'src/app/ratings';

@Component({
  selector: 'app-recipe-details',
  templateUrl: './recipe-details.component.html',
  styleUrls: ['./recipe-details.component.scss'],
})
export class RecipeDetailsComponent implements OnInit {
  recipe: Recipe;
  ingredients: Ingredient[] = [];
  ratings: Ratings[] = [];

  constructor(
    private route: ActivatedRoute,
    private recipeAdministrationReqService: RecipeAdministrationReqService
  ) {}

  async ngOnInit() {
    await this.getRecipe();
    console.log(this.ingredients);
    console.log(this.ratings);
  }

  async getRecipe(): Promise<Recipe> {
    const id = +this.route.snapshot.paramMap.get('id');
    await this.recipeAdministrationReqService
      .getServerRecipeDetails(id)
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
}
