import { ApiService } from './api.service';
import { Injectable } from '@angular/core';

@Injectable({
  providedIn: 'root'
})
export class UserService {

  constructor(private api: ApiService) { }
  login(body:any){
    return this.api.postWithError('login.php',body)
  }
}
