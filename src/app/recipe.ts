export class Recipe {
  id: number;
  title: string;
  picture: File;
  servings: number;
  description: string;
  instruction: string;
  createionDate: Date;
  duration: number;
  difficulty: string;
  certified: boolean;
  lastChangeDate: Date;
  userId: number;
  keywords: string;
  ratings: number;
  ingredients: string[];

  constructor(recipe: Recipe) {
    this.id = recipe.id;
    this.title = recipe.title;
    this.picture = recipe.picture;
    this.servings = recipe.servings;
    this.description = recipe.description;
    this.instruction = recipe.instruction;
    this.createionDate = recipe.createionDate;
    this.duration = recipe.duration;
    this.difficulty = recipe.difficulty;
    this.certified = recipe.certified;
    this.lastChangeDate = recipe.lastChangeDate;
    this.userId = recipe.userId;
    this.keywords = recipe.keywords;
    this.ratings = recipe.ratings;
    this.ingredients = recipe.ingredients;
  }

  getId() {
    return this.id;
  }

  getTitle() {
    return this.title;
  }

  getPicture() {
    return this.picture;
  }

  getServings() {
    return this.servings;
  }

  getDescription() {
    return this.description;
  }

  getInstruction() {
    return this.instruction;
  }

  getCreateionDate() {
    return this.createionDate;
  }

  getDuration() {
    return this.duration;
  }

  getDifficulty() {
    return this.difficulty;
  }

  getCertified() {
    return this.certified;
  }

  getLastChangeDate() {
    return this.lastChangeDate;
  }

  getUserId() {
    return this.userId;
  }

  getKeywords() {
    return this.keywords;
  }

  getRatings() {
    return this.ratings;
  }

  getIngredients() {
    return this.ingredients;
  }

  setId( id: number) {
    return this.id;
  }

  setTitle(title: string) {
    return this.title;
  }

  setPicture(picture: File) {
    return this.picture;
  }

  setServings(servings: number) {
    return this.servings;
  }

  setDescription(description: string) {
    return this.description;
  }

  setInstruction(instruction: string) {
    return this.instruction;
  }

  setCreateionDate(createionDate: Date) {
    return this.createionDate;
  }

  setDuration(duration: number) {
    return this.duration;
  }

  setDifficulty(difficulty: string) {
    return this.difficulty;
  }

  setCertified(certified: number) {
    return this.certified;
  }

  setLastChangeDate(lastChangeDate: Date) {
    return this.lastChangeDate;
  }

  setUserId(userId: number) {
    return this.userId;
  }

  setKeywords(keywords: string) {
    return this.keywords;
  }

  setRatings(ratings: number) {
    return this.ratings;
  }

  setIngredients( ingredients: string) {
    return this.ingredients;
  }

  cleanRecipe() {
    this.id = null;
    this.title = '';
    this.picture = null;
    this.servings = null;
    this.description = '';
    this.instruction = '';
    this.createionDate = null;
    this.duration = null;
    this.difficulty = '';
    this.certified = null;
    this.lastChangeDate = null;
    this.userId = null;
    this.keywords = '';
    this.ratings = null;
    this.ingredients = null;
  }
}
