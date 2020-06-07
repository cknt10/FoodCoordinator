import { Component, OnInit } from '@angular/core';
import { FormBuilder, Validator } from '@angular/forms';

@Component({
  selector: 'app-search',
  templateUrl: './search.component.html',
  styleUrls: ['./search.component.scss']
})
export class SearchComponent implements OnInit {

  zutat: string;
  zutaten = [];

  constructor() { }

  ngOnInit(): void {
  }

  addIngredient(){
    if (this.zutat){
      this.zutaten.push(this.zutat);
      this.zutat ="";
    }
    else {
      window.alert("Bitte füge eine Zutat hinzu!");
    }
  }

  search(){
    window.alert("Hier gibts noch nichts, geh weiter!");
  }

}
