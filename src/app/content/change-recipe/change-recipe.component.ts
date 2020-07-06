import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';
import { Ingredient} from 'src/app/Ingredient';
import { Recipe } from 'src/app/recipe';
import { ActivatedRoute } from '@angular/router';
import { AuthenticationService } from 'src/app/authentication.service';
import { RecipeAdministrationReqService } from 'src/app/recipe-administration-req.service';

@Component({
  selector: 'app-change-recipe',
  templateUrl: './change-recipe.component.html',
  styleUrls: ['./change-recipe.component.scss']
})

export class ChangeRecipeComponent implements OnInit {
  recipe: Recipe;
  title: String;
  difficulty: String;
  shortDescription: String;
  keyword: String;
  keywords: string[] = [];
  amount: Number;
  unit: Number;
  ingredient: String;
  ingredients: Ingredient[] = [];
  duration: Number;
  servings: String;
  description: String;

  imageUrl: String;
  fileToUpload: File = null;
  picture: string;


  constructor(
    private route: ActivatedRoute,
    private router: Router,
    private user: AuthenticationService,
    private recipeAdministrationReqService: RecipeAdministrationReqService,
    ) { }

  ngOnInit(): void {

  }

  changeRecipe(){

  }

  addKeyword(){

  }

  removeKeyword(){

  }

  addIngredient(){

  }

  removeIngredient(){

  }

  handleFileInput(file: FileList){
    this.fileToUpload= file.item(0);

    //Show image preview
    var reader= new FileReader();
    reader.readAsDataURL(this.fileToUpload);
    let text = reader;
    reader.onload = (event:any) =>{
      console.log(text.result)
      this.imageUrl = <string>text.result;
      this.picture = <string>text.result;
    };
  }



}
