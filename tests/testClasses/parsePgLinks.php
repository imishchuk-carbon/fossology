<?php


/***********************************************************
 Copyright (C) 2008 Hewlett-Packard Development Company, L.P.

 This program is free software; you can redistribute it and/or
 modify it under the terms of the GNU General Public License
 version 2 as published by the Free Software Foundation.

 This program is distributed in the hope that it will be useful,
 but WITHOUT ANY WARRANTY; without even the implied warranty of
 MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 GNU General Public License for more details.

 You should have received a copy of the GNU General Public License along
 with this program; if not, write to the Free Software Foundation, Inc.,
 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
 ***********************************************************/

/**
 * Given a fossology page, parse all the href's in it and return them in
 * an array
 *
 * @param string $page the xhtml page to parse
 *
 * @return assocative array.  Can return an empty array indicating
 * nothing on the page to browse.
 *
 * @version "$Id: $"
 * Created on Aug 22, 2008
 */

class parsePgLinks
{
  public $page;
  private $test;

  function __construct($page)
  {
    if (empty ($page))
    {
      return;
    }
    $this->page = $page;
  }
  /**
   * function parseLicFileList
   * given a fossology List Files based on License page parse the
   * list(s) on the page.
   *
   * @returns array of assocative arrays. Each assocative array
   * is ordered by folder names with the last key being the
   * filename. An empty array is returned if no license paths on that
   * page.
   */
  function parsePgLinks()
  {
    // The line below is great for pasring hrefs out of a page
    $regExp = "<a\s[^>]*href=(\'??)([^\'>]*?)\\1[^>]*>(.*)<\/a>";
    $matches = preg_match_all("|$regExp|iU", $this->page, $links, PREG_SET_ORDER);
    print "links are:\n";
    print_r($links) . "\n";
    //$lstFilesLic[] = $this->_createRtnArray($pathList, $matches);
    //return ($lstFilesLic);
  }
  function _createRtnArray($list, $matches)
  {
    /*
     * if we have a match, the create return array, else return empty
     * array
     */
    if ($matches > 0)
    {
      $numPaths = count($list[3]);
      //print "numPaths is:$numPaths\n";
      //print "list is:\n";
      //print_r($list) . "\n";

      $rtnList = array ();
      for ($i = 0; $i <= $numPaths -1; $i++)
      {
        $cleanKey = trim($list[3][$i], "\/<>b");
        $rtnList[$cleanKey] = $list[2][$i];
      }
      return ($rtnList);
    } else
    {
      return (array ());
    }
  }
}
?>
