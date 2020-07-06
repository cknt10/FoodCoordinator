import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';
import { AuthenticationService } from '../../authentication.service';
import { RecipeAdministrationReqService } from '../../recipe-administration-req.service';
import { PremiumReqService } from '../../premium-req.service'
import { Recipe } from 'src/app/recipe';

@Component({
  selector: 'app-my-recipes',
  templateUrl: './my-recipes.component.html',
  styleUrls: ['./my-recipes.component.scss']
})
export class MyRecipesComponent implements OnInit {
  recipes: Recipe[] = [];

  constructor(
    private authenticationService: AuthenticationService,
    private recipeAdministrationService: RecipeAdministrationReqService,
    private premiumReqService: PremiumReqService,
    private router: Router,
  ) { }

  async ngOnInit() {
    //if (this.authenticationService.getUser() != null){
      this.recipes = await this.recipeAdministrationService.getServerUserRecipe(this.authenticationService.getUser());
    /*}else{
      this.recipes = await this.recipeAdministrationService.getServerUserRecipe(this.premiumReqService.getPremiumUser());
    }*/
    console.log(this.recipes);
  }

  throwError() {
    console.log(this.recipeAdministrationService.getErrorMessage());
    //window.alert(this.error);
  }


}
