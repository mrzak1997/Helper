import { TOUCH_BUFFER_MS } from '@angular/cdk/a11y/input-modality/input-modality-detector';
import { Component, ElementRef, OnInit, ViewChild } from '@angular/core';

@Component({
  selector: 'app-dashboard',
  templateUrl: './dashboard.component.html',
  styleUrls: ['./dashboard.component.scss']
})
export class DashboardComponent implements OnInit {
  overflow = 'hidden'
  time:any;
  menu_item = ['منو','منو','منو','منو','منو '];
  menu_closed = true;
  constructor(private eleRef: ElementRef) { }

  ngOnInit(): void {
  }
  close_menu(){
    this.overflow= 'hidden';
    this.menu_closed = !this.menu_closed
    if(!this.menu_closed){
      let time = setTimeout(() => {
        this.overflow= 'visible';
      }, 500);
    }
  } 
}
