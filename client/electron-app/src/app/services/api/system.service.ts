import { ApiService } from './api.service';
import { Injectable } from '@angular/core';

@Injectable({
  providedIn: 'root'
})
export class SystemService {

  constructor(private api: ApiService) { }

  getMenuItems(){
    return this.api.get('get_menu_items.php');
  }
}
