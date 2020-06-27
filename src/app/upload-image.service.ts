import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';

@Injectable({
  providedIn: 'root'
})
export class UploadImageService {

  constructor(
    private http: HttpClient
  ) { }

postfile(caption:string, fileToUpload: File){
  const endpoint = 'http://localhost:14568/api/UploadImage';
  const formData: FormData = new FormData();
  formData.append('Image', fileToUpload, fileToUpload.name);
  formData.append('ImageCaption', caption);
  return this.http
          .post(endpoint, formData);
}


}
