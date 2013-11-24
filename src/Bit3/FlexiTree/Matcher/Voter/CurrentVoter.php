<?php

/**
 * FlexiTree
 *
 * @package FlexiTree
 * @author  Tristan Lins <tristan.lins@bit3.de>
 * @link    http://bit3.de
 * @license http://www.gnu.org/licenses/lgpl-3.0.html LGPL
 */

namespace Bit3\FlexiTree\Matcher\Voter;

use Bit3\FlexiTree\ItemInterface;

/**
 * Class CurrentVoter
 */
class CurrentVoter implements VoterInterface
{
	/**
	 * {@inheritdoc}
	 */
	public function matchItem(ItemInterface $item)
	{
		if ($item->isCurrent()) {
			return true;
		}

		return null;
	}
}