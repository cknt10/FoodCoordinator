import { Component, OnInit } from '@angular/core';
import { Ingredient } from 'src/app/ingredient';
import { RecipeAdministrationReqService } from 'src/app/recipe-administration-req.service';
import { SearchReqService } from 'src/app/search-req.service';
import { AuthenticationService } from 'src/app/authentication.service';
import { SearchParameter } from 'src/app/searchParameter';

@Component({
  selector: 'app-create-recipe',
  templateUrl: './create-recipe.component.html',
  styleUrls: ['./create-recipe.component.scss'],
})
export class CreateRecipeComponent implements OnInit {
  title: string;
  shortDescription: string;
  keyword: string;
  keywords: string[] = [];
  ingredient: string;
  ingredients: Ingredient[] = [];
  description: string;
  picture: string;
  servings: number;
  duration: number;
  amount: number;
  unit: string;
  difficulty: string;
  options: string[] = [];

  fileToUpload: File = null;
  imageUrl: string = "/assets/ich.jpg";

  serverIngredients: SearchParameter[] = [];
  serverKeywords: SearchParameter[] = [];
  allParamsOfIngredient: Ingredient;

  constructor(
    private recipeAdministrationReqService: RecipeAdministrationReqService,
    private searchReqService: SearchReqService,
    private authenticationService: AuthenticationService
  ) {}

  async ngOnInit() {
    await Promise.all([
      this.searchReqService.getServerIngredients(),
      this.searchReqService.getServerKeywords(),
    ]).then((data) => {
      this.serverIngredients = data['0'];
      this.serverKeywords = data['1'];
    });

    console.log(this.serverIngredients);
    console.log(this.serverKeywords);

    //funktioniert nicht beim neuladen der seite
    /*this.serverIngredients = this.searchReqService.getIngredients();
      this.serverKeywords = this.searchReqService.getKeywords();
      console.log(this.serverIngredients);
  console.log(this.serverKeywords);*/
  }

  addIngredient() {
    let idIngredient: number;
    if (this.ingredient != null && this.amount != null && this.unit != null) {
      idIngredient = this.recipeAdministrationReqService.convertRecipeIngredient(
        this.ingredient
      );
      this.allParamsOfIngredient = new Ingredient(
        idIngredient,
        this.ingredient,
        this.amount,
        this.unit,
        null
      );
      this.ingredient = null;
      this.amount = null;
      this.unit = null;

      this.ingredients.push(this.allParamsOfIngredient);
      this.allParamsOfIngredient = null;
    } else {
      window.alert('Bitte füge eine Zutat hinzu!');
    }
  }

  addKeyword() {
    if (this.keyword != null) {
      this.keywords.push(this.keyword);
      this.keyword = '';
    } else {
      window.alert('Bitte füge ein Stichwort hinzu!');
    }
  }

   handleFileInput(file: FileList){
    this.fileToUpload= file.item(0);

    //Show image preview
    var reader= new FileReader();
    reader.readAsDataURL(this.fileToUpload);
    let text = reader;
    reader.onload = (event:any) =>{
      console.log(text.result)
      this.imageUrl = event.target.result;
      this.picture = <string>text.result;
    };
  }

   async createRecipe(){

     this.addIngredient();
     this.addKeyword();
     console.log(this.picture);
     if (this.title != null
     && this.servings != null
     && this.shortDescription != null
     && this.description != null
     && this.duration != null
     && this.difficulty != null
     && this.ingredients != null){
     console.log(await this.recipeAdministrationReqService.getNewServerRecipe(
       this.title,
       this.picture,
       this.servings,
       this.shortDescription,
       this.description,
       this.duration,
       this.difficulty,
      this.authenticationService.getUser().getId(),
       this.keywords,
       this.ingredients))
     }else{
      window.alert("Bitte füllen Sie alle Felder aus!");
     }

    this.picture = null;
    this.imageUrl = "/assets/ich.jpg";
  }



  throwError() {
    console.log(this.recipeAdministrationReqService.getErrorMessage());
    //window.alert(this.error);
  }
}
