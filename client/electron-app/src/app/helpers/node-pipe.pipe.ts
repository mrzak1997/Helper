import { Pipe, PipeTransform } from '@angular/core';

@Pipe({
  name: 'nodePipe',
  pure: false
})
export class NodePipe implements PipeTransform {

  transform(items: any[], filter: Object): any {
    //console.log(items)
    //console.log(filter)


  // filter items array, items which match and return true will be indexOf(filter !== -1)
  // kept, false will be filtered out
  return items.filter(item => item.node_id != filter);
  }

}
