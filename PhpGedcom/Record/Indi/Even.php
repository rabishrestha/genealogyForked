<?php

declare(strict_types=1);

/**
 * php-gedcom
 *
 * php-gedcom is a library for parsing, manipulating, importing and exporting
 * GEDCOM 5.5 files in PHP 5.3+.
 *
 * @author          Kristopher Wilson <kristopherwilson@gmail.com>
 * @copyright       Copyright (c) 2010-2013, Kristopher Wilson
 * @license         MIT
 *
 * @link            http://github.com/mrkrstphr/php-gedcom
 */

namespace PhpGedcom\Record\Indi;

use PhpGedcom\Record;

/**
 * Class Even
 */
class Even extends Record implements Record\Noteable, Record\Objectable, Record\Sourceable
{
    /**
     * @var array
     */
    public $ref = [];

    /**
     * @var string
     */
    protected $type;

    /**
     * @var string
     */
    protected $date;

    /**
     * @var Even\Plac
     */
    protected $plac;

    /**
     * @var string
     */
    protected $caus;

    /**
     * @var string
     */
    protected $age;

    /**
     * @var Record\Addr
     */
    protected $addr;

    /**
     * @var array
     */
    protected $phon = [];

    /**
     * @var string
     */
    protected $agnc;

    /**
     * @var array
     */
    protected $obje = [];

    /**
     * @var array
     */
    protected $sour = [];

    /**
     * @var array
     */
    protected $note = [];

    /**
     * @var Record\Chan
     */
    protected $chan;

    /**
     * @return array
     */
    public function getPhon()
    {
        return $this->phon;
    }

    /**
     * @return Even
     */
    public function addPhon(Record\Phon $phon)
    {
        $this->phon[] = $phon;

        return $this;
    }

    /**
     * @return array
     */
    public function getObje()
    {
        return $this->obje;
    }

    /**
     * @return Even
     */
    public function addObje(Record\ObjeRef $obje)
    {
        $this->obje[] = $obje;

        return $this;
    }

    /**
     * @return array
     */
    public function getSour()
    {
        return $this->sour;
    }

    /**
     * @return Even
     */
    public function addSour(Record\SourRef $sour)
    {
        $this->sour[] = $sour;

        return $this;
    }

    /**
     * @return array
     */
    public function getNote()
    {
        return $this->note;
    }

    /**
     * @return Even
     */
    public function addNote(Record\NoteRef $note)
    {
        $this->note[] = $note;

        return $this;
    }

    /**
     * @return Even
     */
    public function setAddr(Record\Addr $addr)
    {
        $this->addr = $addr;

        return $this;
    }

    /**
     * @return Record\Addr
     */
    public function getAddr()
    {
        return $this->addr;
    }

    /**
     * @param  string  $age
     * @return Even
     */
    public function setAge($age)
    {
        $this->age = $age;

        return $this;
    }

    /**
     * @return string
     */
    public function getAge()
    {
        return $this->age;
    }

    /**
     * @param  string  $agnc
     * @return Even
     */
    public function setAgnc($agnc)
    {
        $this->agnc = $agnc;

        return $this;
    }

    /**
     * @return string
     */
    public function getAgnc()
    {
        return $this->agnc;
    }

    /**
     * @param  string  $caus
     * @return Even
     */
    public function setCaus($caus)
    {
        $this->caus = $caus;

        return $this;
    }

    /**
     * @return string
     */
    public function getCaus()
    {
        return $this->caus;
    }

    /**
     * @param  string  $date
     * @return Even
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * @return string
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @return Even
     */
    public function setPlac(Even\Plac $plac)
    {
        $this->plac = $plac;

        return $this;
    }

    /**
     * @return Even\Plac
     */
    public function getPlac()
    {
        return $this->plac;
    }

    /**
     * @param  string  $type
     * @return Even
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param  array  $ref
     * @return Even
     */
    public function setRef($ref)
    {
        $this->ref = $ref;

        return $this;
    }

    /**
     * @return array
     */
    public function getRef()
    {
        return $this->ref;
    }

    /**
     * @return Record\Chan
     */
    public function getChan()
    {
        return $this->chan;
    }

    /**
     * @param  Record\Chan  $chan
     * @return $this
     */
    public function setChan($chan)
    {
        $this->chan = $chan;

        return $this;
    }
}
