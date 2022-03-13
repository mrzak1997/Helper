
import { SystemService } from './../../services/api/system.service';

import { Component, ElementRef, OnInit, Renderer2, ViewChild } from '@angular/core';
import { ActivatedRoute } from '@angular/router';

@Component({
  selector: 'app-dashboard',
  templateUrl: './dashboard.component.html',
  styleUrls: ['./dashboard.component.scss']
})
export class DashboardComponent implements OnInit {
  height = '50px';
  menu_items:any ;
  overflow = 'hidden';
  time:any;
  menu_item = ['منو','منو','منو','منو','منو '];
  menu_closed = true;
  constructor(private eleRef: ElementRef, private sysService: SystemService,private route: ActivatedRoute,private renderer: Renderer2) {
    console.log(this.route.snapshot.children[0]?.routeConfig?.path);
    this.sysService.getMenuItems().subscribe(res=>{
      this.menu_items = res.body
      console.log(this.menu_items)
    })
   }

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
  menu_click(target:any,count:any){
    let opened = this.eleRef.nativeElement.querySelector('.opened');
    if(opened != null){
        this.renderer.removeClass(opened,'opened')
        this.renderer.setStyle(opened,'height','50px')
    }
    let classes = target.getAttribute("class");
    if(classes.indexOf('menu_item_stuff') > -1){// clicked on menu_stuff
      
      if(classes.indexOf('down') > -1){
        this.renderer.removeClass(target,'down')
      }else{
        this.renderer.addClass(target,'down')
      }
    }else{                                     // clicked on insides of menu_stuff
      target = this.renderer.parentNode(target)
      classes = target.getAttribute("class");
      if(classes.indexOf('down') > -1){
        this.renderer.removeClass(target,'down')
      }else{
        this.renderer.addClass(target,'down')
      }
    }
    let parent = this.renderer.parentNode(target);
    classes = parent.getAttribute("class");
      if(classes.indexOf('opened') > -1){
        this.renderer.removeClass(parent,'opened')
        this.renderer.setStyle(parent,'height','50px')
      }else{
        this.renderer.addClass(parent,'opened')
        let height = ((count*50) +50 ) + 'px'
        this.renderer.setStyle(parent,'height',height)
      }
  }
}
